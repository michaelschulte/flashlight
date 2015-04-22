<?
function array2table($array, $recursive = false, $return = false, $null = '&nbsp;')
{
    // Sanity check
    if (empty($array) || !is_array($array)) {
        return false;
    }
 
    if (!isset($array[0]) || !is_array($array[0])) {
        $array = array($array);
    }
 
    // Start the table
    $table = "<html><body><table>\n";
 
    // The header
    $table .= "\t<tr>";
    // Take the keys from the first row as the headings
    foreach (array_keys($array[0]) as $heading) {
        $table .= '<th >' . $heading . '</th>';
    }
    $table .= "</tr>\n";
 
    // The body
    foreach ($array as $row) {
		$i=1;
        $table .= "\t<tr>" ;
        foreach ($row as $cell) {
            $table .= '<td>';
			if($i==4){
			$cell = wordwrap($cell,20,"\n",true);
			//echo $cell;
			}
			$i++;
            // Cast objects
            if (is_object($cell)) { $cell = (array) $cell; }
            
            if ($recursive === true && is_array($cell) && !empty($cell)) {
                // Recursive mode
                $table .= "\n" . array2table($cell, true, true) . "\n";
            } else {
                $table .= (strlen($cell) > 0) ?
                    htmlspecialchars((string) $cell) :
                    $null;
            }
 
            $table .= '</td>';
        }
 
        $table .= "</tr>\n";
    }
 
    // End the table
    $table .= '</body></table></html>';
 
    // Method of output
    if ($return === false) {
        echo $table;
    } else {
        return $table;
    }
}
?>