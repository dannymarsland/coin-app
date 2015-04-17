<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>Coin App | Danny Marsland</title>

        <!-- omitting standard head tags for brevity -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">

        {literal}
            <script type="text/javascript">
                (function(){
                    document.documentElement.className = document.documentElement.className.replace('no-js','');
                })();
            </script>
        {/literal}

    </head>
    <body>
        <div class="container">
            <header class="page-header">
                <h1>Coin App</h1>
            </header>
            <div class="jumbotron">
                <form action="/" method="get">
                    <label>
                        Value: <input id="user-value" name="value" type="text" value="{$userValue}"/>
                    </label>
                    <input type="submit" value="Calculate"/>
                </form>
            </div>
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    </body>
</html>