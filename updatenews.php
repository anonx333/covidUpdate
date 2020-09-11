<html>
    <head>
        <title>

        </title>
        <style>
            * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            }

            body {
            background-color: #eee;
            font-family: 'helvetica neue', helvetica, arial, sans-serif;
            color: #222;
            }

            #form {
            max-width: 700px;
            padding: 2rem;
            box-sizing: border-box;
            }

            .form-field {
            display: flex;
            margin: 0 0 1rem 0;
            }
            label, input {
            width: 70%;
            padding: 0.5rem;
            box-sizing: border-box;
            justify-content: space-between;
            font-size: 1.1rem;
            }
            label {
            text-align: right;
            width: 30%;
            }
            input {
            border: 2px solid #aaa;
            border-radius: 2px;
            }

            table {
            border-collapse: collapse;
            }
            th {
            background: #ccc;
            }

            th, td {
            border: 1px solid #ccc;
            padding: 8px;
            max-width: 400px;
            }

            tr:nth-child(even) {
            background: #efefef;
            }

            tr:hover {
            background: #d1d1d1;
            }

        </style>
        <script src="jquery-3.5.0.min.js"></script>
    </head>
    <body>
        <form method="post" action="addnews.php" id="form" class="validate">
            <div class="form-field">
                <label for="token">Token</label>
                <input type="text" name="token" id="appToken" placeholder="Access Token" required />
            </div>
            <div class="form-field">
                <label for="newstitle">News Title</label>
                <input type="text" name="newstitle" id="newstitle" placeholder="News Title" required />
            </div>
            <div class="form-field">
                <label for="newsdesc">Description</label>
                <textarea name="newsdesc" id="newsdesc" cols="30" rows="10"></textarea>
            </div>
            <div class="form-field">
                <label for="newslink">Link</label>
                <input type="text" name="newslink" id="newslink" placeholder="News Link" required />
            </div>
            <div class="form-field">
                <label for="newssource">Source</label>
                <input type="text" name="newssource" id="newssource" placeholder="News Link" required />
            </div>
            <div class="form-field">
                <label for="newsdate">Date</label>
                <input type="text" name="newsdate" id="newsdate" placeholder="News Date" required />
            </div>
            <div class="form-field">
                <label for=""></label>
                <input type="button" onclick="updateNews()" value="Submit" />
            </div>
            <div class="form-field">
                <label for=""></label>
                <input type="button" id="autoFetchBtn" value="Auto Fetch" onclick="autoFetch()"/>
            </div>
            <div class="form-field">
                <label for="cookieValue">Cookie Value</label>
                <input type="text" name="cookieValue" id="cookieValue" placeholder="Cookie" required />
            </div>
            <div class="form-field">
                <label for=""></label>
                <input type="button" onclick="setcookie()" value="Set Cookie" />
            </div>
        </form>
        
        <div style="padding-left:221px">
            <table class="my_table">
                <tr>
                    <th>Title</th>
                    <th>Link</th>
                    <th>Date</th>
                    <th>Token</th>
                    <th>Delete</th>
                </tr>
                <?php
                    include 'dbConnect.php';
                    $sql = "SELECT * FROM news ORDER BY newsid DESC, newsdate DESC LIMIT 30";
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        // output data of each row
                        while($row = $result->fetch_assoc()) {
                            
                ?>
                <tr>
                <td><?php echo $row["newstitle"] ?></td>
                <td><a href='<?php echo $row["newslink"]  ?>'> <?php echo $row["newslink"]?></a></td>
                <td><?php echo $row["newsdate"]  ?></td>
                <td><input type="text" name="token" id="tokenid<?php echo $row['newsid'] ?>"></td>
                <td><button onclick="deleteNews('<?php echo $row['newsid'] ?>')">DELETE</button></td>
                </tr>

                <?php 
                        }
                    } 
                    $conn->close();
                ?>
            </table>
        </div>
    </body>
    <script>
        var autoAutoFetch;

        $(document).ready(function () {
            autoAutoFetch = setTimeout(function(){automaticallyAutoFetch();}, 900000);
        });

        function setCookie(cname,cvalue,exdays) {
            var d = new Date();
            d.setTime(d.getTime() + (exdays*24*60*60*1000));
            var expires = "expires=" + d.toGMTString();
            document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
                }
            }
            return "";
        }


        function automaticallyAutoFetch(){
            $('#appToken').val(getCookie("tokenCookie"));
            autoFetch();
        }

        function setcookie(){
            cookieValue = $('#cookieValue').val();
            setCookie("tokenCookie",cookieValue,5);
        }

        function updateNews(){
            var token       = $('#appToken').val();
            var newstitle   = $('#newstitle').val();
            var newssource  = $('#newssource').val();
            var newslink    = $('#newslink').val();
            var newsdesc    = $('#newsdesc').val();
            var newsdate    = $('#newsdate').val();

            $.ajax({
                type: 'POST',
                url: 'addnews.php',
                data: { 
                    'token'      : token, 
                    'newstitle'  : newstitle,
                    'newssource' : newssource,
                    'newsdesc'   : newsdesc,
                    'newslink'   : newslink,
                    'newsdate'   : newsdate
                },
                success: function(msg){
                    location.reload();
                }
            });
            
        }                    

        function deleteNews(x){
            var token = $('#tokenid'+x).val();

            $.ajax({
                type: 'POST',
                url: 'deletenews.php',
                data: { 
                    'token': token, 
                    'newsid': x
                },
                success: function(msg){
                    location.reload();
                }
            });
            
        }

        function autoFetch(){
            var token = $('#appToken').val();
            $.ajax({
                type: 'POST',
                url: 'autofetch.php',
                data: { 
                    'token': token
                },
                success: function(msg){
                   location.reload();
                }
            });
        }

    </script>
</html>