<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />

    <title>simple page result - Bootdey.com</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link href="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet" />
    <style type="text/css">
        body {
            margin-top: 20px;
            background: #eee;
        }

        /** Page Search
 *************************************************** **/
        .search-result {
            padding: 20px 0;
            border-bottom: #eee 1px solid;
        }

        .search-result h4 {
            margin: 0;
            line-height: 20px;
        }

        .search-result p {
            font-size: 12px;
            margin: 0;
            padding: 0;
        }

        .search-result img {
            float: left;
            margin-right: 10px;
            margin-top: 6px;
        }

        /**    17. Panel
 *************************************************** **/
        /* pannel */
        .panel {
            position: relative;

            background: transparent;

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;

            -webkit-box-shadow: none;
            -moz-box-shadow: none;
            box-shadow: none;
        }

        .panel.fullscreen .accordion .panel-body,
        .panel.fullscreen .panel-group .panel-body {
            position: relative !important;
            top: auto !important;
            left: auto !important;
            right: auto !important;
            bottom: auto !important;
        }

        .panel.fullscreen .panel-footer {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
        }

        .panel>.panel-heading {
            text-transform: uppercase;

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .panel>.panel-heading small {
            text-transform: none;
        }

        .panel>.panel-heading strong {
            font-family: Arial, Helvetica, Sans-Serif;
        }

        .panel>.panel-heading .buttons {
            display: inline-block;
            margin-top: -3px;
            margin-right: -8px;
        }

        .panel-default>.panel-heading {
            padding: 15px 15px;
            background: #fff;
        }

        .panel-default>.panel-heading small {
            color: #9e9e9e;
            font-size: 12px;
            font-weight: 300;
        }

        .panel-clean {
            border: 1px solid #ddd;
            border-bottom: 3px solid #ddd;

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .panel-clean>.panel-heading {
            padding: 11px 15px;
            background: #fff !important;
            color: #000;
            border-bottom: #eee 1px solid;
        }

        .panel>.panel-heading .btn {
            margin-bottom: 0 !important;
        }

        .panel>.panel-heading .progress {
            background-color: #ddd;
        }

        .panel>.panel-heading .pagination {
            margin: -5px;
        }

        .panel-default {
            border: 0;
        }

        .panel-light {
            border: rgba(0, 0, 0, 0.1) 1px solid;
        }

        .panel-light>.panel-heading {
            padding: 11px 15px;
            background: transaprent;
            border-bottom: rgba(0, 0, 0, 0.1) 1px solid;
        }

        .panel-heading a.opt>.fa {
            display: inline-block;
            font-size: 14px;
            font-style: normal;
            font-weight: normal;
            margin-right: 2px;
            padding: 5px;
            position: relative;
            text-align: right;
            top: -1px;
        }

        .panel-heading>label>.form-control {
            display: inline-block;
            margin-top: -8px;
            margin-right: 0;
            height: 30px;
            padding: 0 15px;
        }

        .panel-heading ul.options>li>a {
            color: #999;
        }

        .panel-heading ul.options>li>a:hover {
            color: #333;
        }

        .panel-title a {
            text-decoration: none;
            display: block;
            color: #333;
        }

        .panel-body {
            background-color: #fff;
            padding: 15px;

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .panel-body.panel-row {
            padding: 8px;
        }

        .panel-footer {
            font-size: 12px;
            border-top: rgba(0, 0, 0, 0.02) 1px solid;
            background-color: rgba(0255, 255, 255, 1);

            -webkit-border-radius: 0;
            -moz-border-radius: 0;
            border-radius: 0;
        }

        .text-default {
            color: #c6c6c6 !important;
        }

        .text-danger {
            color: #b92c28 !important;
        }

        .text-warning {
            color: #e38d13 !important;
        }

        .text-info {
            color: #28a4c9 !important;
        }

        .text-primary {
            color: #245580 !important;
        }

        .text-success {
            color: #02b700 !important;
        }
    </style>
</head>

<body>
    <div id="content" class="container">
        <div class="panel panel-default">
            <div class="panel-body">
                <h6 class="nomargin">

                </h6>
                <hr class="nomargin-bottom margin-top-10" />

                <div class="container">
                    <h1>{{ $website->name }}</h1>
                    <p>{{ $website->description }}</p>
                    <p><a href="{{ $website->url }}" target="_blank">{{ $website->url }}</a></p>
                    <p>Category: <span class="badge badge-primary">{{ $website->category->name }}</span></p>

                    <a href="{{ route('index') }}" class="btn btn-secondary">Back to List</a>
                </div>
               
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://netdna.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    <script type="text/javascript"></script>
</body>

</html>
