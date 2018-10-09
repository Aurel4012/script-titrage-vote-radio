<?php
class Radio
{

    public $fields = array( );
    public $fieldsDefaults = array( "Server Status", "Stream Status", "Listener Peak", "Average Listen Time", "Stream Title", "Content Type", "Stream Genre", "Stream URL", "Current Song" );
    public $usingDefaults;
    public $very_first_str;
    public $domain;
    public $port;
    public $path;
    public $errno;
    public $errstr;
    public $trackLists = array( );
    public $isShoutcast;
    public $isIcecast;
    public $nonShoutcastData = array( 'Server Status' => "n/a", 'Server Type' => "n/a", 'Stream Status' => "n/a", 'Listener Peak' => "n/a", 'Average Listen Time' => "n/a", 'Stream Title' => "n/a", 'Content Type' => "n/a", 'Stream Genre' => "n/a", 'Stream Description' => "n/a", 'Stream URL' => "n/a", 'Stream AIM' => "n/a", 'Stream IRC' => "n/a", 'Current Song' => "n/a", 'Current Listeners' => "n/a", 'Bitrate' => "n/a" );
    public $altServer = False;

    public function Radio( $url )
    {
        $parsed_url = parse_url( $url );
        $this->domain = isset( $parsed_url['host'] ) ? $parsed_url['host'] : "";
        $this->port = !isset( $parsed_url['port'] ) || empty( $parsed_url['port'] ) ? "80" : $parsed_url['port'];
        $this->path = empty( $parsed_url['path'] ) ? "/" : $parsed_url['path'];
        if ( empty( $this->domain ) )
        {
            $this->domain = $this->path;
            $this->path = "";
        }
        $this->setOffset( "Current Stream Information" );
        $this->setFields( );
        $this->setTableStart( "<table border=0 cellpadding=2 cellspacing=2>" );
        $this->setTableEnd( "</table>" );
    }

    public function setFields( $array = False )
    {
        if ( !$array )
        {
            $this->fields = $this->fieldsDefaults;
        }
        else
        {
            $this->fields = $array;
        }
    }

    public function setOffset( $string )
    {
        $this->very_first_str = $string;
    }

    public function setTableStart( $string )
    {
        $this->tableStart = $string;
    }

    public function setTableEnd( $string )
    {
        $this->tableEnd = $string;
    }

    public function getHTML( $page = False )
    {
        if ( !$page )
        {
            $page = $this->path;
        }
        $contents = "";
        $domain = substr( $this->domain, 0, 7 ) == "http://" ? substr( $this->domain, 7 ) : $this->domain;
        if ( @( $fp = @fsockopen( @$domain, @$this->port, @$this->errno, @$this->errstr, 2 ) ) )
        {
            fputs( $fp, "GET ".$page." HTTP/1.1\r\n"."User-Agent: Mozilla/4.0 (compatible; MSIE 5.5; Windows 98)\r\n"."Accept: */*\r\n"."Host: ".$domain."\r\n\r\n" );
            $c = 0;
            while ( !feof( $fp ) && $c <= 20 )
            {
                $contents .= fgets( $fp, 4096 );
                ++$c;
            }
            fclose( $fp );
            $this->isShoutcast = False;
            $this->isIcecast = False;
            preg_match( "/(Content-Type:)(.*)/i", $contents, $matches );
            if ( 0 < count( $matches ) )
            {
                $contentType = trim( $matches[2] );
                if ( $contentType == "text/html" )
                {
                    $this->isShoutcast = True;
                    return $contents;
                }
                $htmlContent = substr( $contents, 0, strpos( $contents, "\r\n\r\n" ) );
                $dataStr = str_replace( "\r", "\n", str_replace( "\r\n", "\n", $contents ) );
                $lines = explode( "\n", $dataStr );
                foreach ( $lines as $line )
                {
                    if ( $dp = strpos( $line, ":" ) )
                    {
                        $key = substr( $line, 0, $dp );
                        $value = trim( substr( $line, $dp + 1 ) );
                        if ( preg_match( "/genre/i", $key ) )
                        {
                            $this->nonShoutcastData['Stream Genre'] = $value;
                        }
                        else if ( preg_match( "/name/i", $key ) )
                        {
                            $this->nonShoutcastData['Stream Title'] = $value;
                        }
                        else if ( preg_match( "/server/i", $key ) )
                        {
                            $this->nonShoutcastData['Stream Type'] = $value;
                        }
                        else if ( preg_match( "/description/i", $key ) )
                        {
                            $this->nonShoutcastData['Stream Description'] = $value;
                        }
                        else if ( preg_match( "/content-type/i", $key ) )
                        {
                            $this->nonShoutcastData['Content Type'] = $value;
                        }
                        else if ( preg_match( "/icy-br/i", $key ) )
                        {
                            $this->nonShoutcastData['Stream Status'] = "Stream is up at ".$value."kbps";
                            $this->nonShoutcastData['Bitrate'] = $value;
                            $this->isIcecast = $Tmp_151;
                        }
                        else if ( preg_match( "/icy-notice2/i", $key ) )
                        {
                            $this->nonShoutcastData['Server Status'] = "This is <span style=\"color: red;\">not</span> a Shoutcast server!";
                            if ( preg_match( "/ultravox/i", $value ) )
                            {
                                $this->nonShoutcastData .= "Server Status";
                            }
                            $this->altServer = $value;
                        }
                        else if ( preg_match( "/url/i", $key ) )
                        {
                            $Var_3984['Stream URL'] = $value;
                        }
                    }
                }
                if ( $this->isIcecast )
                {
                    $this->nonShoutcastData['Server Type'] = "Icecast";
                    $this->getIcecastStatusHtml( );
                }
                return nl2br( $htmlContent );
            }
            return $contents;
        }
        return False;
    }

    public function getIcecastStatusHtml( $page = "/status.xsl" )
    {
        $contents = "";
        $domain = substr( $this->domain, 0, 7 ) == "http://" ? substr( $this->domain, 7 ) : $this->domain;
        if ( @( $fp = @fsockopen( @$domain, @$this->port, @$this->errno, @$this->errstr, 2 ) ) )
        {
            fputs( $fp, "GET ".$page." HTTP/1.1\r\n"."User-Agent: Mozilla/4.0 (compatible; MSIE 5.5; Windows 98)\r\n"."Accept: */*\r\n"."Host: ".$domain."\r\n\r\n" );
            $c = 0;
            while ( !feof( $fp ) )
            {
                $contents .= fgets( $fp, 4096 );
                ++$c;
            }
            fclose( $fp );
            $tables = explode( "<table", $contents );
            foreach ( $tables as $table )
            {
                if ( preg_match( "/(<td(.*)>".$this->nonShoutcastData['Stream Title']."<\\/td>)/", $table ) )
                {
                    $rows = explode( "<tr>", $table );
                    foreach ( $rows as $row )
                    {
                        if ( preg_match_all( "/<td.*>(.*)<\\/td>/siU", $row, $matches ) )
                        {
                            $type = trim( str_replace( ":", "", $matches[1][0] ) );
                            $value = $matches[1][1];
                            if ( $type == "Current Song" )
                            {
                                $this->nonShoutcastData['Current Song'] = $value;
                            }
                            else if ( $type == "Current Listeners" )
                            {
                                $this->nonShoutcastData['Current Listeners'] = $value;
                            }
                            else if ( $type == "Peak Listeners" )
                            {
                            }
                        }
                    }
                }
            }
        }
    }

    public function getServerInfo( $display_array = null, $very_first_str = null )
    {
        if ( !isset( $display_array ) )
        {
            $display_array = $this->fields;
        }
        if ( !isset( $very_first_str ) )
        {
            $very_first_str = $this->very_first_str;
        }
        if ( $html = $this->getHTML( ) )
        {
            $data = array( );
            foreach ( $display_array as $key => $item )
            {
                if ( $this->isShoutcast )
                {
                    $very_first_pos = nhix( $html, $very_first_str );
                    $first_pos = nhix( $html, $item, $very_first_pos );
                    $line_start = strpos( $html, "<td>", $first_pos );
                    $line_end = strpos( $html, "</td>", $line_start ) + 4;
                    $difference = $line_end - $line_start;
                    $line = substr( $html, $line_start, $difference );
                    $data[$key] = strip_tags( $line );
                }
                else
                {
                    $data[$key] = $this->nonShoutcastData[$item];
                }
            }
            return $data;
        }
        return $this->errstr." (".$this->errno.")";
    }

    public function createHistoryArray( $page )
    {
        if ( !in_array( $page, $this->trackLists ) )
        {
            $this->trackLists[] = $page;
            if ( $html = $this->getHTML( $page ) )
            {
                $fromPos = nhix( $html, $this->tableStart );
                $toPos = nhix( $html, $this->tableEnd, $fromPos );
                $tableData = substr( $html, $fromPos, $toPos - $fromPos );
                $lines = explode( "</tr><tr>", $tableData );
                $tracks = array( );
                $c = 0;
                foreach ( $lines as $line )
                {
                    $info = explode( "</td><td>", $line );
                    $time = trim( strip_tags( $info[0] ) );
                    if ( substr( $time, 0, 9 ) != "Copyright" && !preg_match( "/nhstudio", $info[1] ) )
                    {
                        $this->tracks[$c]['time'] = $time;
                        $this->tracks[$c++]['track'] = trim( strip_tags( $info[1] ) );
                    }
                }
                unset( $Var_2016[0] );
                if ( 0 < count( $this->tracks ) && isset( $this->tracks[1] ) )
                {
                    $this->tracks[1]['track'] = str_replace( "Current Song", "", $this->tracks[1]['track'] );
                }
            }
            else
            {
                $this->tracks[0] = array( "time" => $this->errno, "track" => $this->errstr );
            }
        }
    }

    public function getHistoryArray( $page = "/played.html" )
    {
        if ( !in_array( $page, $this->trackLists ) )
        {
            $this->createHistoryArray( $page );
        }
        return $this->tracks;
    }

    public function getHistoryTable( $page = "/played.html", $timeColText = False, $trackColText = False, $class = False )
    {
        if ( !in_array( $page, $this->trackLists ) )
        {
            $this->createHistoryArray( $page );
        }
        $output = "<table".( $class ? " class=\"".$class."\"" : "" ).">";
        if ( $timeColText && $trackColText )
        {
            $output .= "<tr><td>".$timeColText."</td><td>".$trackColText."</td></tr>";
        }
        foreach ( $this->tracks as $trackArr )
        {
            $output .= "<tr><td>".$trackArr['time']."</td><td>".$trackArr['track']."</td></tr>";
        }
        $output .= "</table>\n";
        return $output;
    }

}

echo "<meta http-equiv=\"content-type\" content=\"text/html;charset=utf-8\">\r\n";
if ( !function_exists( "nhix" ) )
{
    function nhix( $haystack, $needle, $offset = 0 )
    {
        return strpos( strtoupper( $haystack ), strtoupper( $needle ), $offset );
    }
}
?>
