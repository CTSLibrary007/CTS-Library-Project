<section id="home">
    <h2>Hey <?php echo $_SESSION['name']; ?>,</h2>
</section>
<section id="request">
    <h2>Requests</h2>
    <div id="request-panel">
        <?php
            $demanddata = $conn->query("select * from demand");
            $borrowdata = $conn->query("select * from borrowed where Check_Status = 'Yet to be borrowed'");
            if ($demanddata->num_rows > 0) {
                while($demandinfo = $demanddata->fetch_array()) {
                    $q1='select TIME_TO_SEC(TIMEDIFF(CURRENT_TIMESTAMP, "'.$demandinfo['DemandDate'].'")) as timediff';
                    $res1=mysqli_fetch_array($conn->query($q1));
                    $mindiff = 7*86400;  //Sets minimum difference time of 7 days
                    if ($res1['timediff'] > $mindiff) {
                        $conn -> query('DELETE FROM demand where AccNo = "'.$demandinfo['AccNo'].'"');
                        $conn -> query('UPDATE `books` SET `Status`="Available" WHERE `AccNo` = "'.$demandinfo['AccNo'].'"');
                        continue;
                    }
                }
            }
            if ($borrowdata->num_rows > 0) {
                while($borrowinfo = $borrowdata->fetch_array()) {
                    $q1='select TIME_TO_SEC(TIMEDIFF(CURRENT_TIMESTAMP, "'.$borrowinfo['BorrDt'].'")) as timediff';
                    $res1=mysqli_fetch_array($conn->query($q1));
                    $mindiff = 7*86400;  //Sets minimum difference time of 7 days
                    if ($res1['timediff'] > $mindiff) {
                        $conn -> query('DELETE FROM borrowed where AccNo = "'.$borrowinfo['AccNo'].'"');
                        $conn -> query('UPDATE `books` SET `Status`="Available" WHERE `AccNo` = "'.$borrowinfo['AccNo'].'"');
                        continue;
                    }
                }
            }
        ?>
        <div id="request-panel-options">
            <div id="demand-request-page" class="active">Demand Requests (<?php echo mysqli_fetch_array($conn->query('SELECT COUNT(`DemandID`) FROM `demand` WHERE `Check_Status` = "Yet to be verified"'))[0]; ?>)</div>
            <div id="borrow-request-page">Borrow Requests (<?php echo mysqli_fetch_array($conn->query('SELECT COUNT(`BorrowID`) FROM `borrowed` WHERE `Check_Status` != "Borrowed"'))[0]; ?>)</div>
            <div id="group-request-page">Group Requests (<?php echo 0; ?>)</div>
        </div>
        <div id="request-panel-requests">
            <div id="demand-request-content" class="active">
                <div class="available-books-content">
                    <?php
                        $q="SELECT `demand`.*, `students`.Name, `students`.Card_No, `books`.* FROM `demand`
                        INNER JOIN students ON `demand`.StdID = `students`.Card_No
                        INNER JOIN books ON `demand`.AccNo = `books`.AccNo
                        WHERE `demand`.`Check_Status` = \"Yet to be verified\"
                        ORDER BY demand.DemandDate ASC";
                        $demanddata = mysqli_query($conn,$q);
                        if(mysqli_num_rows($demanddata) > 0) {
                    ?>
                    <div class="search-results">
                    <?php
                            while($demandinfo = mysqli_fetch_array($demanddata)) {
                    ?>
                    <div class="search-results-bookinfo">
                        <div class="search-results-bookinfo-bookpic">
                            <img src="../Essential Kits/pic/photorealistic.png" alt="Book Cover">
                        </div>
                        <div class="search-results-bookinfo-bookinfo">
                            <div class="search-results-bookinfo-secinfo">Demanded on: <?php echo date_format(date_create($demandinfo['DemandDate']),"M j, Y g:i A"); ?></div>
                            <div class="search-results-bookinfo-secinfo">Acc. No.:<?php echo $demandinfo['AccNo']; ?></div>
                            <div class="search-results-bookinfo-title"><?php echo $demandinfo['Title']; ?></div>
                            <div class="search-results-bookinfo-secinfo">By <?php echo $demandinfo['Author']; ?>, </div>
                            <div class="search-results-bookinfo-edition">Demanded by <?php echo $demandinfo['Name'];?> (<?php echo $demandinfo['Card_No'];?>)</div>
                            <div class="search-results-bookinfo-publisher"><?php echo $demandinfo['Publisher']; ?></div>
                            <div class="search-results-bookinfo-secinfo">Click to show options</div>
                        </div>
                        <div class="search-results-bookinfo-options">
                            <div class="search-results-bookinfo-optionset">
                                <button onclick="window.location = ('../Dashboard/Dashboard.php?did=<?php echo $demandinfo['AccNo']; ?>&dopt=con')" class="search-results-bookinfo-optionset-btn green">
                                    Confirm demand request
                                </button>
                                <button onclick="window.location = ('../Dashboard/Dashboard.php?did=<?php echo $demandinfo['AccNo']; ?>&dopt=del')" class="search-results-bookinfo-optionset-btn red">
                                    Cancel demand request
                                </button>
                                <button class="search-results-bookinfo-optionset-btn gray">
                                    Close box
                                </button>
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
                        <img src="../Essential Kits/pic/ddsa.png" alt="">
                        <p class="nobooks-text">All clear!</p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div id="borrow-request-content">
                <div class="available-books-content">
                    <?php
                        $q="SELECT * FROM borrowed
                        INNER JOIN students ON borrowed.LibID = students.Card_No
                        INNER JOIN books ON borrowed.AccNo = books.AccNo
                        WHERE borrowed.Check_Status != 'Borrowed' ORDER BY borrowed.BorrDt";
                        $borrowdata = mysqli_query($conn,$q);
                        if(mysqli_num_rows($borrowdata) > 0) {
                    ?>
                    <div class="search-results">
                    <?php
                            while($borrowinfo = mysqli_fetch_array($borrowdata)) {
                    ?>
                    <div class="search-results-bookinfo <?php if($borrowinfo['Check_Status'] == 'Return Approval') echo 'rotate'; ?>">
                        <div class="search-results-bookinfo-bookpic">
                            <img src="../Essential Kits/pic/photorealistic.png" alt="Book Cover">
                        </div>
                        <div class="search-results-bookinfo-bookinfo">
                            <div class="search-results-bookinfo-secinfo">Borrowed on: <?php echo date_format(date_create($borrowinfo['BorrDt']),"M j, Y g:i A"); ?></div>
                            <div class="search-results-bookinfo-secinfo">Acc. No.:<?php echo $borrowinfo['AccNo']; ?></div>
                            <div class="search-results-bookinfo-title"><?php echo $borrowinfo['Title']; ?></div>
                            <div class="search-results-bookinfo-secinfo">By <?php echo $borrowinfo['Author']; ?>, </div>
                            <div class="search-results-bookinfo-edition"><?php if ($borrowinfo['Check_Status'] == "Yet to be borrowed") echo "Borrower: "; elseif($borrowinfo['Check_Status'] == "Return Approval") echo "Returning Book by: "; echo $borrowinfo['Name']." (".$borrowinfo['Card_No'].")";?></div>
                            <div class="search-results-bookinfo-publisher"><?php echo $borrowinfo['Publisher']; ?></div>
                            <div class="search-results-bookinfo-secinfo">Click to show options</div>
                        </div>
                        <div class="search-results-bookinfo-options">  <!-- Work from here dude :") -->
                            <div class="search-results-bookinfo-optionset">
                                <?php
                                    if ($borrowinfo['Check_Status'] == "Yet to be borrowed") {
                                ?>
                                <button onclick="window.location = ('../Dashboard/Dashboard.php?bid=<?php echo $borrowinfo['AccNo']; ?>&bopt=issue')" class="search-results-bookinfo-optionset-btn green">
                                    Issue book
                                </button>
                                <button onclick="window.location = ('../Dashboard/Dashboard.php?bid=<?php echo $borrowinfo['AccNo']; ?>&bopt=del')" class="search-results-bookinfo-optionset-btn red">
                                    Cancel borrow request
                                </button>
								<?php
									}
									elseif ($borrowinfo['Check_Status'] == "Return Approval") {
								?>
								<button onclick="window.location = ('../Dashboard/Dashboard.php?bid=<?php echo $borrowinfo['AccNo']; ?>&bopt=del')" class="search-results-bookinfo-optionset-btn green">
                                    Confirm return
                                </button>
								<?php
									}
								?>
								<button class="search-results-bookinfo-optionset-btn gray">
                                    Close box
                                </button>
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
                        <img src="../Essential Kits/pic/ddsa.png" alt="">
                        <p class="nobooks-text">All clear!</p>
                    </div>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div id="group-request-content">
                Group requests here...
            </div>
        </div>
    </div>
</section>
<section id="notification">
    <h2>Notification Page</h2>
    <div id="notification-area">
        <div id="notification-resizer"></div>
        <div id="notification-content">
            <div id="create-notification">
                <div class="icon"><ion-icon name="add-circle-outline"></ion-icon></div><div>Create new notice</div>
            </div>
            <div id="writing-system">
                <p>Apply Filters</p>
                <div id="filter-select">  
                    <div>
                        <button id = "all" name = "all" value = "All">All</button>
                    </div>

                    <div>
                        <select name="department" id="dept">
                            <option value = "" selected>Department</option>
                            <?php
                                $deptrows = $conn -> query("select * from department");
                                if (mysqli_num_rows($deptrows) > 0) {
                                    while ($deptrow = mysqli_fetch_array($deptrows)) {
                                        echo '<option value = "'.$deptrow['dept_id'].'">'.$deptrow['dept_name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div>
                        <select name="year" id="yr">
                            <option value = "" selected>Year</option>
                            <?php
                                $yearrows = $conn -> query("select * from `year`");
                                if (mysqli_num_rows($yearrows) > 0) {
                                    while ($yearrow = mysqli_fetch_array($yearrows)) {
                                        echo '<option value = "'.$yearrow['year_no'].'">'.$yearrow['year_name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div>
                        <select name="group" id="gr">
                            <option value = "" selected>Group</option>
                            <?php
                                $grouprows = $conn -> query("select * from `group`");
                                if (mysqli_num_rows($grouprows) > 0) {
                                    while ($grouprow = mysqli_fetch_array($grouprows)) {
                                        echo '<option value = "'.$grouprow['group_name'].'">'.$grouprow['group_name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                    </div>
                    
                    <div>
                        <select name="individual" id="ind">
                            <option value = "" selected>Individual</option>
                            <?php
                                $deptrows = $conn -> query("select * from department");
                                if (mysqli_num_rows($deptrows) > 0) {
                                    while ($deptrow = mysqli_fetch_array($deptrows)) {
                                        if (mysqli_num_rows($conn -> query("select * from `students` where `Course` = '".$deptrow['dept_id']."'")) > 0) {
                                            echo '<optgroup label = "'.$deptrow['dept_id'].'">';
                                            $yearrows = $conn -> query("select * from `year`");
                                            if (mysqli_num_rows($yearrows) > 0) {
                                                while ($yearrow = mysqli_fetch_array($yearrows)) {
                                                    $indrows = $conn -> query("select * from `students` where `Course` = '".$deptrow['dept_id']."' and `Year` = '".$yearrow['year_name']."'");
                                                    if (mysqli_num_rows($indrows) > 0) {
                                                        echo '<optgroup label = "' . $yearrow['year_name'] . '">';
                                                        while ($indrow = mysqli_fetch_assoc($indrows)) {
                                                            echo '<option value = "'.$indrow['Card_No'].'::'.$indrow['Name'].'">'.$indrow['Name'].'</option>';
                                                        }
                                                        echo '</optgroup>';
                                                    }
                                                }
                                            }
                                            echo '</optgroup>';
                                        }
                                    }
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <form id = "form" action="./Result.php" method="post">
                    <p>Applied filters:</p>
                    <div id = "checked"></div>    
                    <div>
                        <label for="sub">Subject</label><br>
                        <input type="text" name="subject" id="sub" placeholder="Subject">
                    </div>
                    <div>
                        <label for="textarea">Notice</label><br>
                        <div id="notification-textarea">
                            <div id="previewtext">
                                <div id="preview">
                                </div>
                            </div>
                            <div id="formattable">
                                <textarea name="textarea" id="textarea" tabindex="101"></textarea>
                                <div id="formatbox">
                                    <div id="bold" class="material-symbols-rounded"  title="Bold (Ctrl+B)">format_bold</div>
                                    <div id="italic" class="material-symbols-rounded" title="Italic (Ctrl+I)">format_italic</div>
                                    <div id="underline" class="material-symbols-rounded" title="Underline (Ctrl+U)">format_underlined</div>
                                    <div id="lalign" class="material-symbols-rounded" title="Left align (Ctrl+L)">format_align_left</div>
                                    <div id="calign" class="material-symbols-rounded" title="Center align (Ctrl+E)">format_align_center</div>
                                    <div id="ralign" class="material-symbols-rounded" title="Right align (Ctrl+R)">format_align_right</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="submit" value="Submit">
                </form>
            </div>
        </div>
    </div>
</section>
<section id="account-management">
    <h2>Student Accounts (<?php echo mysqli_num_rows($conn -> query("SELECT * FROM students")); ?>)</h2>

</section>