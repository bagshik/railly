<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Railly</title>
        <link href="/css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-fixed-top">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#railly-navbar">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="/"><img src="/img/railly.png">Rail.ly</a>
                </div>
                <div class="collapse navbar-collapse" id="railly-navbar">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="active"><a href="#">Home</a></li>
                        <li><a href="#">Stations</a></li>
                        <li><a href="#">About</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="background-image"></div>
        <div class="jumbotron">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <h1>Plan your journey...</h1>
                        <form>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="sr-only" for="depart">Depart</label>
                                        <div class="input-group">
                                        <div class="input-group-addon">From</div>
                                        <input type="text" class="form-control" id="fromStation" placeholder="Brussels">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label class="sr-only" for="arrival">Arrival</label>
                                        <div class="input-group">
                                        <div class="input-group-addon">To</div>
                                        <input type="text" class="form-control" id="toStation" placeholder="Antwerp">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <select class="form-control">
                                            <option>I will be leaving on...</option>
                                            <option>I will be arriving on...</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <div class="input-group date" id="datetimepicker1">
                                            <span class="input-group-addon">
                                                <span class="glyphicon glyphicon-calendar"></span>
                                            </span>
                                            <input type="text" class="form-control" placeholder="October 31, 2016 12:30 AM">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">Check for availables trains</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="/js/app.js"></script>
    </body>
</html>
