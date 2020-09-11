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
        <form action="#" id="form" class="validate">
            <div class="form-field">
                <label for="token">Token</label>
                <input type="text" name="token" id="appToken" placeholder="Access Token" required />
            </div>
            <div class="form-field">
                <label for=""></label>
                <input type="button" value="Fetch Data" onclick="fetchData()"/>
            </div>
        </form>
    </body>
    <script>

        function fetchData(){
            var token = $('#appToken').val();
            $.ajax({
                type: 'POST',
                url: 'autofetch.php',
                dataType: 'JSON',
                data: { 
                    'token': token,
                    'localfetch': "local"
                },
                success: function(msg){
                    for(var i = 0; i < msg.length; i++)
                    {
                        var today = new Date();
                        var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();

                        $.ajax({
                        type: 'POST',
                        url: 'http://kukhurikan.com/addnews.php',
                        dataType: 'JSON',
                        data: { 
                            'token'       : token,
                            'newstitle'   : msg[i].newstitle,
                            'newslink'    : msg[i].newslink,
                            'newsdate'    : date,
                            'newsdesc'    : msg[i].newstitle,
                            'newssource'  : msg[i].newssource,
                        },
                        success:function(response){

                        }
                        });
                    }
                }
            });
        }

    </script>
</html>