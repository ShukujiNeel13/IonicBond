<!DOCTYPE html>
<html lang='ja'>
<head>
  <meta charset="utf-8">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="/css/materialize.css"  media="screen,projection"/>
  <link type="text/css" rel="stylesheet" href="/css/common.css"  media="screen,projection"/>

</head>

<body>
  <main>
    <div class="row ">
      <div class="col s12 grey lighten-3">
        <ul class="tabs grey lighten-3">
          <li class="tab col s3"><a href="#Tab_General">General</a></li>
          <li class="tab col s3"><a href="#Tab_Employee">Employee</a></li>
          <li class="tab col s3"><a href="#Tab_Events">Events</a></li>
          <li class="tab col s3"><a href="#Tab_Analysis">Analysis</a></li>
        </ul>
      </div>
      <br><br><br><br><br>
      <div id="Tab_General" class="col s12">
        <div class="col s12">
          <br><br><br>
        </div>
        <h5 class="center light-blue-text col s4"><i class="medium material-icons">flash_on</i></h5>
        <table class="col s6">
          <thead>
            <tr>
              <td>Company Name</td>
              <td>WWC Co.</td>
            </tr>
            <tr>
              <td>Employee No</td>
              <td>6</td>
            </tr>
            <tr>
              <td>Membership</td>
              <td>Trial</td>
            </tr>
          </thead>
        </table>
        <div class="col s12">
          <br><br><br>
        </div>
      </div>
      <div id="Tab_Employee" class="col s12 ">

        <div class="container">
        <div class="row">
          <form class="col s12">
            <div class="row">
              <div class="input-field col s6">
                <input id="name" type="text" class="validate">
                <label for="name">Employee Name</label>
              </div>
              <div class="input-field col s6">
                <input id="employee_ID" type="number" class="validate">
                <label for="employee_ID">Employee ID</label>
              </div>
            </div>

            <div class="row">
              <div class="input-field col s6">
                <input id="role" type="text" class="validate">
                <label for="role">Role</label>
              </div>
              <div class="input-field col s6">
                <input id="department" type="text" class="validate">
                <label for="department">Department</label>
              </div>
            </div>


            <button class="btn waves-effect waves-light" type="submit" name="action">Submit
              <i class="material-icons right">send</i>
            </button>
          </form>



        </div>
        </div>
        <br><br><br>

        <ul class="collection container">
          <li class="collection-item avatar">
            <img src="images/test_activity.jpg" alt="" class="circle">
            <span class="title">Title</span>
            <p>First Line <br>
              Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
          </li>
          <li class="collection-item avatar">
            <i class="material-icons circle">folder</i>
            <span class="title">Title</span>
            <p>First Line <br>
              Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
          </li>
          <li class="collection-item avatar">
            <i class="material-icons circle green">insert_chart</i>
            <span class="title">Title</span>
            <p>First Line <br>
              Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
          </li>
          <li class="collection-item avatar">
            <i class="material-icons circle red">play_arrow</i>
            <span class="title">Title</span>
            <p>First Line <br>
              Second Line
            </p>
            <a href="#!" class="secondary-content"><i class="material-icons">grade</i></a>
          </li>
        </ul>

      </div>
      <div id="Tab_Events" class="col s12">
        <div class="container">
          <div class="row">
            <div class="col s3">
              <div class="card">
                <div class="card-image">
                  <img src="images/test_activity.jpg">
                  <span class="card-title">Card Title</span>
                </div>
                <div class="card-content">
                  <span class="blue-text">Status: Published</span>
                  <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
                <div class="card-action grey">
                  <a href="#" class="white-text">DELETE</a>
                </div>
              </div>
            </div>

            <div class="col s3">
              <div class="card">
                <div class="card-image">
                  <img src="images/test_activity.jpg">
                  <span class="card-title">Card Title</span>
                  <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
                </div>
                <div class="card-content">
                  <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
              </div>
            </div>

            <div class="col s3">
              <div class="card">
                <div class="card-image">
                  <img src="images/test_activity.jpg">
                  <span class="card-title">Card Title</span>
                  <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
                </div>
                <div class="card-content">
                  <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
              </div>
            </div>

            <div class="col s3">
              <div class="card">
                <div class="card-image">
                  <img src="images/test_activity.jpg">
                  <span class="card-title">Card Title</span>
                  <a class="btn-floating halfway-fab waves-effect waves-light red"><i class="material-icons">add</i></a>
                </div>
                <div class="card-content">
                  <p>I am a very simple card. I am good at containing small bits of information. I am convenient because I require little markup to use effectively.</p>
                </div>
              </div>
            </div>
          </div>

        </div>



      </div>
      <div id="Tab_Analysis" class="col s12 ">
        <div class="container">
          Analysis will be implemented in the future version.<br>
          To put some graph images.
        </div>
      </div>
    </div>

  </main>
  <footer class="page-footer red lighten-3">
    <div class="container">
      <div class="row">
        <div class="col l6 s12">
          <h5 class="white-text">We welcome your feedback</h5>
          <p class="grey-text text-lighten-4">If you have any suggestion to this app, please contact us anytime.</p>


        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Contact</h5>
          <ul>
            <li><a class="white-text" href="#!">Team6 Office</a></li>
          </ul>
        </div>
        <div class="col l3 s12">
          <h5 class="white-text">Settings</h5>
        </div>
      </div>
    </div>
    <div class="footer-copyright">
      <div class="container">
        Made by <a class="orange-text text-lighten-3" href="http://materializecss.com">Materialize</a>
      </div>
    </div>
  </footer>

  <script type="text/javascript" src="/js/materialize.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
  <script src="/js/common.js"></script>

</body>
