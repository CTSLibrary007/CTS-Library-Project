<section id="home">
    <h2>Hello there,</h2>
    <h2><?php echo $_SESSION['name']; ?></h2>
    <div>
        <div class="gridbox">
            <div class="gridcard">
                <div class="gridcard-content">
                    <?php
                        $q='select * from borrowed where LibID="'.$_SESSION['user'].'" ORDER BY `borrowed`.`BorrDt` DESC';
                        $query = mysqli_query($conn,$q);
                        // echo mysqli_num_rows($query);
                        if(mysqli_num_rows($query)>0) {
                            $res=mysqli_fetch_array($query);
                            $q='select * from books where AccNo="'.$res['AccNo'].'"';
                            $res=mysqli_fetch_array(mysqli_query($conn,$q));
                    ?>
                    <h3 class="gridcard-heading">Recently borrowed book</h3>
                    <div class="gridcard-context">
                            <p><?php echo $res['Title']?>
                            </p>by <?php echo $res['Author']?>
                    </div>
                    <?php
                        }
                        else {
                    ?>
                        <h3 class="gridcard-heading">You have not taken any books yet</h3>
                        <div class="gridcard-context">Borrow a book now!!</div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="gridcard">
                <div class="gridcard-content">
                    <?php
                        $q='select * from demand where StdID="'.$_SESSION['user'].'" ORDER BY `demand`.`DemandDate` DESC';
                        $query = mysqli_query($conn,$q);
                        // echo mysqli_num_rows($query);
                        if(mysqli_num_rows($query)>0) {
                            $res=mysqli_fetch_array($query);
                            $q='select * from books where AccNo="'.$res['AccNo'].'"';
                            $res=mysqli_fetch_array(mysqli_query($conn,$q));
                    ?>
                        <h3 class="gridcard-heading">Recently demanded book</h3>
                        <div class="gridcard-context">
                            <p><?php echo $res['Title']?>
                            </p>by <?php echo $res['Author']?>
                        </div>
                    <?php
                        }
                        else {
                    ?>
                        <h3 class="gridcard-heading">You have not demanded any books yet</h3>
                        <div class="gridcard-context">Demand a book now!!</div>
                    <?php
                        }
                    ?>
                </div>
            </div>
            <div class="gridcard">
                <div class="gridcard-content">
                    <h3 class="gridcard-heading">Box 3</h3>
                    <div class="gridcard-context">Context 3</div>
                </div>
            </div>
            <div class="gridcard">
                <div class="gridcard-content">
                    <h3 class="gridcard-heading">Box 4</h3>
                    <div class="gridcard-context">Context 4</div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="demanded-books">
    <h2>Demanded Books (<?php echo mysqli_num_rows(mysqli_query($conn,"select * from demand where StdID='".$_SESSION['user']."'")); ?>)</h2>
    <div>
        <div class="available-books-content">
            <?php
                $q="select * from demand where StdID='".$_SESSION['user']."' order by DemandDate DESC";
                $demanddata = mysqli_query($conn,$q);
                if(mysqli_num_rows($demanddata) > 0) {
                    
            ?>
                <div class="search-results">
            <?php
                    while($demandinfo = mysqli_fetch_array($demanddata)) {
                        $bookinfo=mysqli_fetch_array(mysqli_query($conn,'select * from books where AccNo="'.$demandinfo['AccNo'].'"'));
            ?>
                <div class="search-results-bookinfo <?php if($demandinfo['Check_Status'] == 'Yet to be verified') echo "grayscale"; ?>">
                    <div class="search-results-bookinfo-bookpic">
                        <img src="../Essential Kits/pic/photorealistic.png" alt="Book Cover">
                    </div>
                    <div class="search-results-bookinfo-bookinfo">
                        <div class="search-results-bookinfo-secinfo">Demand Date: <?php echo date_format(date_create($demandinfo['DemandDate']),"M j, Y"); ?></div>
                        <div class="search-results-bookinfo-secinfo">Demand Time: <?php echo date_format(date_create($demandinfo['DemandDate']),"g:i A"); ?></div>
                        <div class="search-results-bookinfo-secinfo">Acc. No.:<?php echo $bookinfo['AccNo']; ?></div>
                        <div class="search-results-bookinfo-title"><?php echo $bookinfo['Title']; ?></div>
                        <div class="search-results-bookinfo-edition">(<?php echo $bookinfo['Edition']; ?> Edition)</div>
                        <div class="search-results-bookinfo-secinfo">By <?php echo $bookinfo['Author']; ?></div>
                        <div class="search-results-bookinfo-publisher"><?php echo $bookinfo['Publisher']; ?></div>
                        <div class="search-results-bookinfo-secinfo">Click to show options</div>
                    </div>
                    <div class="search-results-bookinfo-options">
                        <div class="search-results-bookinfo-optionset">
                        <?php
                        $q1='select TIME_TO_SEC(TIMEDIFF(CURRENT_TIMESTAMP, "'.$demandinfo['DemandDate'].'")) as timediff';
                        $res1=mysqli_fetch_array(mysqli_query($conn,$q1));
                        $mindiff = 86400;  //Sets minimum difference time of 1 day
                        if($res1['timediff'] >= $mindiff) {  //If user has demanded a book after minimum day
                            if($demandinfo['Check_Status'] == 'Verified') {
                        ?>
                            <button onclick="window.location = ('../Dashboard/Dashboard.php?did=<?php echo $demandinfo['AccNo']; ?>&dopt=del')" class="search-results-bookinfo-optionset-btn red">
                                Remove from demand list
                            </button>
                            <button onclick="window.location = ('../Dashboard/Dashboard.php?did=<?php echo $demandinfo['AccNo']; ?>&dopt=borr')" class="search-results-bookinfo-optionset-btn green">
                                Borrow this book
                            </button>
                            <button class="search-results-bookinfo-optionset-btn gray">
                                Close box
                            </button>
                        <?php
                            }
                            elseif($demandinfo['Check_Status'] == 'Yet to be verified') {
                        ?>
                            <div class="search-results-bookinfo-optionset-pretext">
                                Not verified by admin!
                            </div>
                            <div class="search-results-bookinfo-optionset-text">
                                Please check after sometime or contact admin
                            </div>
                            <button onclick="window.location = ('../Dashboard/Dashboard.php?did=<?php echo $demandinfo['AccNo']; ?>&dopt=del')" class="search-results-bookinfo-optionset-btn red">
                                Remove from demand list
                            </button>
                            <button class="search-results-bookinfo-optionset-btn gray">
                                Close box
                            </button>
                        <?php
                            }
                        }
                        else {
                        ?>
                            <div class="search-results-bookinfo-optionset-pretext">
                                Options currently not available!
                            </div>
                            <div class="search-results-bookinfo-optionset-text">
                                Please check after sometime
                            </div>
                            <button class="search-results-bookinfo-optionset-btn gray">
                                Close box
                            </button>
                            <?php
                        }
                        ?>
                        </div>
                    </div>
                </div>
            <?php
                    }
            ?>
                </div>
                <?php
                }
                else {
                ?>
                <div class="nobooks">
                    <p class="nobooks">You haven't demanded any books till now...</p>
                </div>
                <?php
                }
                ?>
        </div>
    </div>
</section>
<section id="borrowed-books">
    <h2>Borrowed Books (<?php echo mysqli_num_rows($conn->query("select * from borrowed where LibID='".$_SESSION['user']."'")); ?>)</h2>
    <div>
        <div class="available-books-content">
            <?php
                $q="select * from borrowed where LibID='".$_SESSION['user']."' order by BorrDt DESC";
                $borrowdata = mysqli_query($conn,$q);
                if(mysqli_num_rows($borrowdata) > 0) {
                    
            ?>
                <div class="search-results">
            <?php
                    while($borrowinfo = mysqli_fetch_array($borrowdata)) {
                        $bookinfo=mysqli_fetch_array(mysqli_query($conn,'select * from books where AccNo="'.$borrowinfo['AccNo'].'"'));
            ?>
                <div class="search-results-bookinfo <?php if($borrowinfo['Check_Status'] == 'Yet to be borrowed') echo "grayscale"; elseif ($borrowinfo['Check_Status'] == 'Return Approval') echo "rotate"; ?>">
                    <div class="search-results-bookinfo-bookpic">
                        <img src="../Essential Kits/pic/photorealistic.png" alt="Book Cover">
                    </div>
                    <div class="search-results-bookinfo-bookinfo">
                        <div class="search-results-bookinfo-secinfo">Borrow Date: <?php echo date_format(date_create($borrowinfo['BorrDt']),"M j, Y"); ?></div>
                        <div class="search-results-bookinfo-secinfo">Borrow Time: <?php echo date_format(date_create($borrowinfo['BorrDt']),"g:i A"); ?></div>
                        <div class="search-results-bookinfo-secinfo">Acc. No.:<?php echo $bookinfo['AccNo']; ?></div>
                        <div class="search-results-bookinfo-title"><?php echo $bookinfo['Title']; ?></div>
                        <div class="search-results-bookinfo-edition">(<?php echo $bookinfo['Edition']; ?> Edition)</div>
                        <div class="search-results-bookinfo-secinfo">By <?php echo $bookinfo['Author']; ?></div>
                        <div class="search-results-bookinfo-publisher"><?php echo $bookinfo['Publisher']; ?></div>
                        <div class="search-results-bookinfo-secinfo">Click to show options</div>
                    </div>
                        <div class="search-results-bookinfo-options">
                            <div class="search-results-bookinfo-optionset">
                            <?php
                            $q1='select TIME_TO_SEC(TIMEDIFF(CURRENT_TIMESTAMP, "'.$borrowinfo['BorrDt'].'")) as timediff';
                            $res1=mysqli_fetch_array(mysqli_query($conn,$q1));
                            $mindiff = 86400;  //Sets minimum difference time of 1 day
                            if($res1['timediff'] >= $mindiff) {  //If user has demanded a book after minimum day
                                if ($borrowinfo['Check_Status'] == "Yet to be borrowed") {
                            ?>
								<div class="search-results-bookinfo-optionset-pretext">
									You haven't borrowed this book from the library yet
								</div>
								<div class="search-results-bookinfo-optionset-text">
									Go to the library and contact admin
								</div>
								<button class="search-results-bookinfo-optionset-btn gray">
									Close box
								</button>
                            <?php
                                }
                                elseif ($borrowinfo['Check_Status'] == "Borrowed") {
                            ?>
                                <div class="search-results-bookinfo-optionset-pretext">
                                    Return this book to the Library
                                </div>
                                <button onclick="window.location = ('../Dashboard/Dashboard.php?bid=<?php echo $borrowinfo['AccNo']; ?>&bopt=ret')" class="search-results-bookinfo-optionset-btn green">
                                    Return book
                                </button>
								<button class="search-results-bookinfo-optionset-btn gray">
									Close box
								</button>
                            <?php
                                }
                                elseif ($borrowinfo['Check_Status'] == "Return Approval") {
                            ?>
                                <div class="search-results-bookinfo-optionset-pretext">
									You haven't returned this book yet
								</div>
								<div class="search-results-bookinfo-optionset-text">
									Go to the library and contact admin
								</div>
								<button class="search-results-bookinfo-optionset-btn gray">
									Close box
								</button>
                            <?php
                                }
                            }
                            else {
                            ?>
                                <div class="search-results-bookinfo-optionset-pretext">
                                    Options currently not available!
                                </div>
                                <div class="search-results-bookinfo-optionset-text">
                                    Please check after sometime
                                </div>
                                <button class="search-results-bookinfo-optionset-btn gray">
                                    Close box
                                </button>
                            <?php
                            }
                            ?>
                            </div>
                        </div>
                    </div>
                <?php
                    }
                ?>
                </div>
                <?php
                }
                else {
                ?>
                <div class="nobooks">
                    <img src="../Essential Kits/pic/asdd.png" alt="">
                    <p class="nobooks">Oops!! Seems like there are no such books that you have searched</p>
                    <p class="nobooks">Try to search something else...</p>
                </div>
                <?php
                }
                ?>
        </div>
    </div>
</section>