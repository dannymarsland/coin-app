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
                <h2>Please enter a value</h2>
                <form action="/" method="get">
                    <label>
                        Value: <input id="user-value" name="value" type="text" value="{$userValue}"/>
                    </label>
                    <input type="submit" value="Calculate"/>
                </form>
            </div>

            {if $userValue}
                <div class="jumbotron">
                    {if $error}
                        <h2>Error</h2>
                        <p>{$errorMessage}</p>
                    {else}
                        <h2>Results</h2>
                        <p>User entered £{$formattedValue}. The minimum coins are:</p>
                        <ul>
                            {foreach $coins as $coin}
                                <li><p>{$coin.quantity} x {$coin.name} ( £{$coin.value} ) = £{$coin.total}</p></li>
                            {/foreach}

                        </ul>
                    {/if}
                </div>
            {/if}
        </div>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    </body>
</html>