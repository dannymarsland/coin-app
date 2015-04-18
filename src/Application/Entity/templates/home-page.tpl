<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>Coin App | Danny Marsland</title>

        <!-- omitting standard head tags for brevity -->

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css">
        <link href="//cdn.rawgit.com/noelboss/featherlight/1.2.3/release/featherlight.min.css" type="text/css" rel="stylesheet" title="Featherlight Styles" />

        <style>

            .no-js-only {
                display: none;
            }
            .no-js .no-js-only {
                display: block;
            }


        </style>

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
        </div>
        <div class="container">
            <div class="jumbotron">
                <h2>Please enter a value</h2>
                <p>Values are rounded to the nearest pence</p>
                <form id="value-form" action="/" method="get">
                    <label>
                        Value: <input id="user-value" name="value" type="text" value="{$userValue}"/>
                    </label>
                    <input type="submit" value="Calculate"/>
                </form>
            </div>
        </div>

        {if $hadUserInput}
            <div class="no-js-only">
                <div class="container results" id="results">
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
                </div>
            </div>
        {/if}

        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="//cdn.rawgit.com/noelboss/featherlight/1.2.3/release/featherlight.min.js" type="text/javascript" charset="utf-8"></script>
        <script src="/static/js/app.js" type="text/javascript" charset="utf-8"></script>
    </body>
</html>