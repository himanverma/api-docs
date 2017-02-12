<html>
    <head>
        <title>
            API Documentation
        </title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

        <!-- Latest compiled and minified JavaScript -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    </head>
    <body>
        <script>
            function syntaxHighlight(json) {
                json = JSON.stringify(json, undefined, 4);
                json = json.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;');
                return json.replace(/("(\\u[a-zA-Z0-9]{4}|\\[^u]|[^\\"])*"(\s*:)?|\b(true|false|null)\b|-?\d+(?:\.\d*)?(?:[eE][+\-]?\d+)?)/g, function (match) {
                    var cls = 'number';
                    if (/^"/.test(match)) {
                        if (/:$/.test(match)) {
                            cls = 'key';
                        } else {
                            cls = 'string';
                        }
                    } else if (/true|false/.test(match)) {
                        cls = 'boolean';
                    } else if (/null/.test(match)) {
                        cls = 'null';
                    }
                    return '<span class="' + cls + '">' + match + '</span>';
                });
            }
        </script>

        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="#">Enterprise CHAT (API Documentation)</a>
                </div>
                <div id="navbar" class="collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        <li class="active"><a href="/">Home</a></li>
                        <li><a href="#about">About</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div><!--/.nav-collapse -->
            </div>
        </nav>

        <div class="container">
            <br>
            <br>
            <br>
            <br>
            <div class="panel-group" id="klassAccordion" role="tablist" aria-multiselectable="true">
                
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="klassBlkE">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseKlassE" aria-expanded="true" aria-controls="collapseKlassE">
                                    Endpoints and Credentials
                                </a>
                            </h4>
                        </div>
                        <div id="collapseKlassE" class="panel-collapse collapse" role="tabpanel" aria-labelledby="E">
                            <div class="panel-body">
                                <table class="table table-responsive table-striped">
                                    <tr>
                                        <td>Dev Endpoint:</td>
                                        <td>http://13.54.160.122/api</td>
                                    </tr>
                                </table>
                                
                                <div>
                                    <p>Please send "Accept" = "application/json","Content-Type" = "application/json" and "token" = "FqpkLQNftwbexLgZDur3WobDZmIN2L2x2iIE"  in the headers of every request.</p>
                                </div>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="panel-group" id="klassAccordion" role="tablist" aria-multiselectable="true">
                <?php foreach ($data as $i => $klass) { ?>
                    <div class="panel panel-default">
                        <div class="panel-heading" role="tab" id="klassBlk{{$i}}">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseKlass{{$i}}" aria-expanded="true" aria-controls="collapseKlass{{$i}}">
                                    {{isset($klass['classDoc']['apimodule']) ? $klass['classDoc']['apimodule'] : $klass['class']}}
                                </a>
                            </h4>
                        </div>
                        <div id="collapseKlass{{$i}}" class="panel-collapse collapse" role="tabpanel" aria-labelledby="{{$i}}">
                            <div class="panel-body">
                                <div class="panel-group" id="methodsAccordion" role="tablist" aria-multiselectable="true">
                                    <?php foreach ($klass['methods'] as $j => $method) { 
                                        if(count($method) == 0){
                                            continue;   
                                        }
                                    ?>
                                        <div class="panel panel-default">
                                            <div class="panel-heading" role="tab" id="methodsBlk{{$j}}-{{$i}}">
                                                <h4 class="panel-title">
                                                    <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseMethods{{$j}}-{{$i}}" aria-expanded="true" aria-controls="collapseMethods{{$j}}-{{$i}}">
                                                        <span class="badge"><?php echo str_pad($j + 1, 2, "0",STR_PAD_LEFT) ?></span> {{isset($method['apiname']) ? $method['apiname'] : @$method['apiurl']}}
                                                        {{isset($method['description']) ? $method['description'] : @$method['url']}}
                                                    </a>
                                                </h4>
                                            </div>
                                            <div id="collapseMethods{{$j}}-{{$i}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="{{$j}}--{{$i}}">
                                                <div class="panel-body">
                                                    <table class="table-responsive table table-striped">
                                                        <tbody>
                                                            <?php foreach ($method as $k => $v) { ?>
                                                                <tr>
                                                                    <th>{{$k}}: </th>
                                                                    <td>
                                                                        <?php
                                                                        if (in_array($k,["apirequest","request","response","response2"])) {
                                                                            echo '<pre class="json">' . $v . '</pre>';
                                                                        } else {
                                                                            echo @$v;
                                                                        }
                                                                        ?>
                                                                    </td>
                                                                </tr>
                                                            <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
        <script>
            $('.json').each(function () {
                var v = $(this).html();
                try {
                    v = JSON.parse(v);
                    $(this).html(syntaxHighlight(v));
                } catch (e) {
                    console.log(e)
                }

            });
        </script>
        <style type="text/css">
            pre {outline: 1px solid #ccc; padding: 5px; margin: 5px; }
            .string { color: green; }
            .number { color: darkorange; }
            .boolean { color: blue; }
            .null { color: magenta;
            </style>

        </div><!-- /.container -->
    </body>
</html>