<?php
    include '../Essential Kits/php/conn.php';
    include "../Essential Kits/php/session.php";
    if(isset($_GET['demand'])) {
        $dq = "INSERT INTO demand (AccNo, StdID) VALUES ('".$_GET['demand']."', '".$_SESSION['user']."')";
        $dquery = mysqli_query($conn,$dq);
        $dq="UPDATE books SET Status = 'Demanded' WHERE AccNo = ".$_GET['demand'];
        $dquery = mysqli_query($conn,$dq);
        header('location:Searchbook.php');
    }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include '../Essential Kits/php/Metadata.php'; ?>
    <link rel="stylesheet" href="../Essential Kits/css/Search Results.css">
    <link rel="stylesheet" href="Searchbook-style.css">
    <title>Search Books</title>
</head>

<body>
    <?php
        $searchflag=1;
        include '../Essential Kits/php/Navbar.php';
    ?>
    <div id="main-section">
        <div id="search-engine">
        <form method="get" id="search-engine-searchbox">
            <label for="searchfield" id="searchicon"><span class="fa-solid fa-magnifying-glass"></span></label>
            <div id="searchfield-content">
                <input type="search" name="s" id="searchfield" placeholder="Search and place demand to any books you want..." value="<?php if(isset($_GET['s'])) echo $_GET['s']; ?>" autocomplete="off">
                <ul id="autocomplete"></ul>
            </div>
            <button type="submit" name="b" id="searchbtn" value="search">
                <span class="fa-solid fa-magnifying-glass"></span><p>Search</p>
            </button>
        </form>
        </div>
        <div id="available-books">
            <div class="available-books-content">
                <?php
                    if(!isset($_GET['b'])) {
                        $q="select * from books where Status='Available' order by Title";
                    }
                    else {
                        if(isset($_GET['s']) and $_GET['s']!='') {
                            $key = $_GET['s'];
                            $q="select * from books where (Title like '%$key%' or Author like '%$key%' or Publisher like '%$key%') and Status='Available' order by Title";
                        }
                        else {
                            $q="select * from books where Status='Available' order by Title";
                        }
                    }
                    $booksdata = mysqli_query($conn,$q);
                    if(mysqli_num_rows($booksdata) > 0) {
                        $i=1;
                ?>
                    <div class="context">Available search results (<?php echo mysqli_num_rows($booksdata); ?> found)</div>
                    <div class="search-results">
                <?php
                        while($bookinfo = mysqli_fetch_array($booksdata)) {
                ?>
                    <div class="search-results-bookinfo">
                        <div class="search-results-bookinfo-bookpic">
                            <img src="../Essential Kits/pic/photorealistic.jpg" alt="Book Cover">
                        </div>
                        <div class="search-results-bookinfo-bookinfo">
                            <div class="search-results-bookinfo-secinfo">Acc. No.:<?php echo $bookinfo['AccNo']; ?></div>
                            <div class="search-results-bookinfo-title"><?php echo $bookinfo['Title']; ?></div>
                            <div class="search-results-bookinfo-edition">(<?php echo $bookinfo['Edition']; ?> Edition)</div>
                            <div class="search-results-bookinfo-secinfo">By <?php echo $bookinfo['Author']; ?></div>
                            <div class="search-results-bookinfo-publisher"><?php echo $bookinfo['Publisher']; ?></div>
                            <div class="search-results-bookinfo-secinfo">Click to show options</div>
                        </div>
                        <div class="search-results-bookinfo-options">
                            <?php
                                if(isset($_SESSION['user'])) {  //If session is present
                                    $q='select DemandDate from demand where StdID="'.$_SESSION['user'].'" ORDER BY `demand`.`DemandDate` DESC';
                                    $query = mysqli_query($conn,$q);
                                    if(mysqli_num_rows($query)>0) {  //If user has already given a demand previously
                                        $tempq='select BorrDt from borrowed where LibID="'.$_SESSION['user'].'"';
                                        $tempquery = $conn->query($tempq);
                                        if(mysqli_num_rows($query)+mysqli_num_rows($tempquery)<3) {  //If user has not crossed the limit of taking books
                                            $res=mysqli_fetch_array($query);
                                            $q1='select TIME_TO_SEC(TIMEDIFF(CURRENT_TIMESTAMP, "'.$res['DemandDate'].'")) as timediff';
                                            $res1=mysqli_fetch_array(mysqli_query($conn,$q1));
                                            $mindiff = 259200;  //Sets minimum difference time of 3 days
                                            if($res1['timediff'] >= $mindiff) {  //If user has demanded a book after minimum day
                            ?>
                            <div class="search-results-bookinfo-optionset">
                                <div class="search-results-bookinfo-optionset-pretext">
                                    Add this book to your demand list!
                                </div>
                                <button onclick="window.location = ('../Search Book/Searchbook.php?demand=<?php echo $bookinfo['AccNo']; ?>')" class="search-results-bookinfo-optionset-btn green">
                                    Add to Demand List
                                </button>
                            </div>
                            <?php
                                            }
                                            else {
                                                $reqired_time_query = "
                                                WITH nts as (select TIMESTAMPADD(DAY,3,'".$res['DemandDate']."') as diff_time),
                                                diff_seconds as (select TIME_TO_SEC(TIMEDIFF(diff_time, CURRENT_TIMESTAMP)) as seconds from nts),
                                                diff as (select seconds % 60 as secpart, seconds % 3600 as minpart, seconds % (3600*24) as hourpart from diff_seconds)
                                                select CONCAT(
                                                FLOOR(seconds/3600/24),' days ',
                                                FLOOR(hourpart/3600),' hrs ',
                                                FLOOR(minpart/60),' mins ',
                                                FLOOR(secpart),' s'
                                                ) as difference from diff,diff_seconds
                                                ";
                                                $rtsa = mysqli_fetch_array(mysqli_query($conn,$reqired_time_query));
                                                $rts = $rtsa['difference'];
                            ?>
                            <div class="search-results-bookinfo-optionset">
                                <div class="search-results-bookinfo-optionset-pretext">
                                    You are too early to demand another book!
                                </div>
                                <div class="search-results-bookinfo-optionset-text">
                                    Demand after <?php echo '<b style="padding: 0;">'.$rts.'</b>'; ?>
                                </div>
                            </div>
                            <?php
                                            }
                                        }
                                        else {
                            ?>
                            <div class="search-results-bookinfo-optionset">
                                <div class="search-results-bookinfo-optionset-pretext">
                                    You have reached the maximum limit of demanding or borrowing books!
                                </div>
                                <div class="search-results-bookinfo-optionset-text">
                                    Cancel previous demands or return previously borrowed books
                                </div>
                            </div>
                            <?php
                                        }
                                    }
                                    else {
                            ?>
                            <div class="search-results-bookinfo-optionset">
                                <div class="search-results-bookinfo-optionset-pretext">
                                    Add this book to your demand list!
                                </div>
                                <button onclick="window.location = ('../Search Book/Searchbook.php?demand=<?php echo $bookinfo['AccNo']; ?>')" class="search-results-bookinfo-optionset-btn green">
                                    Add to Demand List
                                </button>
                            </div>
                            <?php
                                    }

                                    
                                }
                                else {
                            ?>
                            <div class="search-results-bookinfo-optionset">
                                <div class="search-results-bookinfo-optionset-pretext">
                                    Sign In to demand this book!
                                </div>
                                <button onclick="window.location = ('../Sign In/signin.php')" class="search-results-bookinfo-optionset-btn green">
                                    Sign In
                                </button>
                            </div>
                            <?php
                                }
                            ?>
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
                    <div id="nobooks">
                        <img src="../Essential Kits/pic/asdd.png" alt="">
                        <p class="nobooks">Oops!! Seems like there are no such books that you have searched</p>
                        <p class="nobooks">Try to search something else...</p>
                    </div>
                    <?php
                    }
                    ?>
            </div>
        </div>
    </div>
    <?php include '../Essential Kits/php/Footer.php'; ?>
    <script src="../Essential Kits/js/Navbar.js"></script>
    <?php include 'suggestions.php'; ?>
    <script src="Searchbook-script.js"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
	<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>
<?php mysqli_close($conn); ?>