<?php
/*	
Task description:
You are in a room with a circle of 100 chairs. The chairs are numbered sequentially from 1 to 100.
At some point in time, the person in chair #1 will be asked to leave. The person in chair #2 will be skipped, and the person in chair #3 will be asked to leave.
This pattern of skipping one person and asking the next to leave will keep going around the circle until there is one person left… the survivor.
Identify  which chair the survivor is sitting on.
*/

/* Solution:
Two methods are solving the same task using algorithms with recursion and without recustion
Performance method is invoking both of them and outputs execution time.
When invoking these methods with at least 10000 elements, performance difference is significant, but with 100 you won't notice the difference.
*/

$range = range(1, 100);
$text = "Survivor is sitting on chair #";  //Text for display result

function getSurvivor($range){
	foreach ($range as $el) {
		if(count($range) == 1){ // If one person is left
			return $range[0]; // Return last person in a room			
		}
		array_shift($range); // Ask odd person to leave a room
		array_push($range,array_shift($range)); // Skip even person 						
	}
}
function getSurvivorRecursion($range, $leave = true){

	foreach ($range as $key=>$el) { // For each person in a room
		if(count($range) == 1){ // If one person is left
			return $range[$key]; // Return last person
		}else{
			if($leave == true){ // If person should leave the room
				$leave = false; // Set false for next person
			}else{
				$new_array[$key] = $el; // Skip this preson
				$leave = true; // Set true for next person
			}
		}		
	}
	return getSurvivorRecursion($new_array,$leave); // Invoke itself with new range
}
function performance($funcName, $range){ // Measure method performance
	$time_start = microtime(true);
	$number = $funcName($range);
	$time_end = microtime(true);
	$time = $time_end - $time_start;	
	return array("time" => $time, "number" => $number);
}

echo "<h1>Results</h1>";
$p = performance('getSurvivor', $range);
echo ("$text {$p['number']}. Performance without recursion {$p['time']} microseconds.");
echo("<br>");

$p = performance('getSurvivorRecursion', $range);
echo ("$text {$p['number']}. Performance with recursion {$p['time']} microseconds.");

?>








