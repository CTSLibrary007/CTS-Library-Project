<script>
	let suggestions = Array.from(new Set([    //Removing duplicate values in the array by converting it to set and reconverting it into array
		<?php
			$sq = "select Title, Author from books";
			$bsq = mysqli_query($conn,$sq);
			$arr = array();
			while($rbsq = mysqli_fetch_array($bsq)) {    //Constructing autosuggestions array
				array_push($arr,$rbsq["Title"]);
				if(strpos($rbsq["Author"],"," == false)) {
					array_push($arr,$rbsq['Author']);
				}
				else {
					$arr = array_merge($arr,explode(",",$rbsq['Author']));
				}
			}
			for($i = 0; $i<sizeof($arr);$i++) {    //Converting php autosuggestion array into js autosuggestions array
				echo '"'.trim($arr[$i]," ").'"';
				if($i!=sizeof($arr)-1) {
					echo ',';
				}
			}
		?>
	]));
</script>