<!DOCTYPE html>
<html>
<head>
    <title>Lojistic | Developer Challenge</title>
    <link rel="icon" type="image/png" href="https://www.lojistic.com/favicon.png"/>
    <link rel="shortcut icon" type="image/png" href="https://www.lojistic.com/favicon.png"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/css/app.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.13/vue.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default">
    <div class="container">
        <div class="col-xs-12 col-sm-5 brand pull-left">
            <b>Lojistic</b> | Developer Challenge
        </div>
        <div class="col-xs-12 col-sm-7 pull-right">
            <ul class="nav nav-pills pull-right">
                <li role="presentation"><a href="/">Instructions</a></li>
                <li role="presentation"><a href="/job-openings"onclick="alert('these dont work yet'); return false;">Job Openings</a></li>
                <li role="presentation"><a href="/applicants" onclick="alert('these dont work yet'); return false;">Applicants</a></li>
            </ul>
        </div>
    </div>
</nav>
<section>
    <div class="container">
        <div class="col-sm-6 col-sm-offset-3">
            <article>
                <h1>We're Making A Crud App</h1>

                <p>
                    Hi. I'm Mike, Senior Code Master at Lojistic.
                </p>

                <p>
                    I have two problems. I need to test applicants on their
                    development chops, and I need to keep track of who has applied to
                    join the team. So we're going to make me a simple application
                    to help me manage job applicants.
                </p>
            </article>
        </div>

        <a id="instructions"></a>
        <div class="row">
            <div class="col-sm-6 col-sm-offset-3">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        Instructions
                    </div>
                <table class="table">
                    <tbody>
                    <tr>
                        <td>&check;</td>
                        <td>
                            Fork, Download, And Install This Repo <br>
                            <small>(You just finished this. Good job, buddy!)</small>
                        </td>
                    </tr>
                    <tr>
                        <td>&cir; </td>
                        <td>
                            Create a Migration, Model, and Controller for our
                            <a href="#job_opening">Job Opening</a>
                            Object
                        </td>
                    </tr>
                    <tr>
                        <td>&cir;</td>
                        <td>
                            Create a Migration, Model, and Controller for our
                            <a href="#applicant">Applicant</a>
                            Object
                        </td>
                    </tr>
                    <tr>
                        <td>&cir;</td>
                        <td>
                            Create a bootstrap page to add/edit/delete/view Job Postings. <br/>
                            <a target="_blank" href="/images/mockup.jpg">ROUGH SKETCH</a>
                        </td>
                    </tr>
                    <tr>
                        <td>&cir;</td>
                        <td>
                            Create a bootstrap page to add/edit/delete/view Applicants. <br>
                            <a target="_blank" href="/images/mockup.jpg">SAME ROUGH SKETCH</a>
                        </td>
                    </tr>
                    <tr>
                        <td>&cir;</td>
                        <td>
                            Create a database seed that creates a record for the Full Stack Developer
                            position. Also create a seed that enters you as an applicant.
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><b style="color:green">BONUS POINTS!</b></td>
                    </tr>
                    <tr>
                        <td>&cir;</td>
                        <td>
                            If you really want to be cool, you can use a front end MV* framework
                            such as Angular or VueJS to control the forms &amp; tables asynchronously.
                            (but it's not a requirement)
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            </div>
        </div>

        <a id="job_opening"></a>

        <div class="row">
            <h2>
                Job Opening Object
                <small><a href="#instructions">Back To Instructions</a></small>
            </h2>

            <p>
                Our Job Opening object is going to hold the general job info for a job that we're trying to fill.
            </p>

            <div class="well">
            <pre>
Job Opening
    id                  integer                 primary key, auto increments
    title               string
    is_available        boolean
                </pre>
            </div>
        </div>

        <a id="applicant"></a>

        <div class="row">
            <h2>
                Applicant Object
                <small><a href="#instructions">Back To Instructions</a></small>
            </h2>

            <p>
                Our Applicant object is going to hold the contact info for developers
                that have applied to this position. It's going to be structured like this:
            </p>

            <div class="well">
            <pre>
Applicant
    id                  integer                 primary key, auto increments
    name                string
    email               string
    phone               string
    github_id           string
    position_id         integer, foreign key
    invitation_date     datetime
    submission_date     datetime
                </pre>
            </div>
        </div>
    </div>
</section>


</body>
</html>
