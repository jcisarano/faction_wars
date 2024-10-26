<?php
echo 'start<br/>';
//create a list of items
$item_id = array(1,2,3,1,5,2);

include_once( 'lib/db_access.php' );
$db = new DatabaseAccess;

$userid=1407955289;
foreach($item_id as $id)
{
    $item = $db->get_item_info($id, $userid);
    $item['quantity'] = 1;
    $items[] = $item;
    echo http_build_query($item) . '<br />';
}

//iterate over a list of items, add to list if not already there,
//else increment current value
foreach($items as $i)
{
    if(!array_key_exists($i['name'], $loot))
    {
          //not already one of these in the list, add a new item
        $loot[$i['name']] = $i;
    }
    else
    {
        $loot[$i['name']]['quantity'] += $i['quantity'];
    }

}

//iterate over item list, output to show results
$output .= '<table>';
foreach($items as $key=>$i)
{
    $output .= '<tr><td>quantity ' . $key . '</td><td>name ' . $i['name'] . '</td><td>q ' . $i['quantity'] . '</td>
               <td>name ' . $loot[$i['name']]['name'] . '</td><td>q ' . $loot[$i['name']]['quantity']
               . '</td></tr>';
}
$output .= '</table>';

echo $output;
echo 'end<br/>';
?>