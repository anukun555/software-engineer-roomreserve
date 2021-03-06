<!DOCTYPE html>
<html lang="en"><head>
    <title>Reservation</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="CG07Q6CxQFBmUXetWruibRxDBe6jXXQ4ZM67Mg6J">



    <!-- Styles -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/css/styleHome.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/styleReservation.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/stylesemantic.css') }}">
     <link rel="stylesheet" href="{{ asset('/css/styleapp.css') }}">

    <script src="{{ asset('/js/styleapp.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.9.0/moment.min.js"></script>

  <link rel="stylesheet" href="{{ asset('/css/Datetimepicker.css') }}">

  <script src="{{ asset('/js/datetimepicker.min.js') }}"></script>


    </head>
<body id="bodycolor">


  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid"style="background-color:#2E2E2E">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
      </div>

      <div class="collapse navbar-collapse" id="myNavbar"style="width: -webkit-fill-available">
        <ul class="nav navbar-nav navbar-left" id="left-Menu">


          <li style="border-bottom:2px solid red;"><a href="/">หน้าหลัก</a></li>





          <li><a href="{{ url('/room/crate') }}" >create-room</a></li>
          <li><a href="{{ url('/room/addtable') }}" >create-table</a></li>
          <li><a href="{{ url('/room/myreseravtion') }}" >My-Reservation</a></li>
        </ul>
        <ul class="nav navbar-nav navbar-right">
           
        
            <li><a href="{{ url('/logout') }}"><span class="glyphicon glyphicon-log-in" ></span> {{Auth::user()->name}}</a></li>
        
        </ul>
      </div>
    </div>
  </nav>


         @foreach($Rooms as $Room)

      <div class="col-md-3 col-sm-4 col-xs-12">
        <div class="card" style="text-align:center">
          <img src="img/demo/{{$Room->remember_token}}" alt="Avatar" style="width:100%">
            <h4><b>{{ $Room->roomName }}</b></h4>
            <p>{{ $Room->roomDescription}}</p>
            <div class="col-md-12 columButton" style="text-align: center;padding-top: 1vw">
              <a href="{{ url('/room/view/'.$Room->roomID.'') }}" target='_parent'><button id="button-menu" data-toggle="modal"><font id="textButton">Show</font></button></a>
              <a href="{{ url('/room/edit') }}" target='_parent'><button id="button-menu1" data-toggle="modal" ><font id="textButton">Edit</font></button></a>

    </div>
        </div>
      </div>
     @endforeach


  







    <div id="loading">
    </div>
    <div id="app">


        <div class="container transition visible" id="allmenu" style="display: block !important;">
    <div class="row">
        <div class="col-md-12 col-md-offset-0">
          <br>
          <br>
          <br>
          <br>

          @if(Session::has('flash_message'))
            <div class="alert alert-danger"><em> <center><li>{!! session('flash_message') !!}</li></center></em></div>
          @endif
          @if(Session::has('flash_message2'))
            <div class="alert alert-success"><em> <center><li>{!! session('flash_message2') !!}</li></center></em></div>
          @endif

          <h2 class="ui left floated header"style="width:100%"><font id="statustext" size="6" color="#B92000">STATUS</font><br>
            <font id="roomnametext" size="5" color="#828282">{{$Room->roomName}}</font>
            <div class="hr"></div>

          </h2>

          </h2>
                    <div class="ui clearing divider"></div>

                    <!-- ////////////////////// ส่วนของตาราง //////////////// -->
                    <?php
                    // ส่วนของตัวแปรสำหรับกำหนด
                    $thai_day_arr=array("จันทร์","อังคาร","พุธ","พฤหัสบดี","ศุกร์","เสาร์","อาทิตย์");
                    $eng_day_arr=array("MO","TU","WE","TH","FR","SA","SU");
                    ////////////////////// ส่วนของการจัดการตารางเวลา /////////////////////
                    $num_dayShow=7;  // จำนวนวันที่โชว์ 1 - 7
                    $sc_timeStep=array("09:00","10:00","11:00","12:00","13:00","14:00","15:00","16:00","17:00","18:00","19:00","20:00","21:00","22:00");
                    $sc_numCol=14;
                    ////////////////////// ส่วนของการจัดการตารางเวลา /////////////////////
                    ?>
                    <br>
                    <div class="wrap_schedule"  style="overflow-x:auto;">
                    <table  align="center" border="1" cellspacing="2" cellpadding="2"style="border-collapse:collapse;" >
                      <tr class="time_schedule">
                        <td align="center" valign="middle" height="50" bgcolor="#101010">
                        &nbsp;</td>
                    <?php
                    for($i_time=0;$i_time<$sc_numCol-1;$i_time++){
                    ?>
                        <td align="center" valign="middle" height="50" bgcolor="#101010">
                        <div class="time_schedule_text" >
                            <font color="#DCDCDC" size="3"><?=$sc_timeStep[$i_time]?> - <?=$sc_timeStep[$i_time+1]?></font>
                        </div>
                        </td>
                    <?php }?>
                      </tr>
                    <?php
                    // วนลูปแสดงจำนวนวันตามที่กำหนด
                    for($i_day=0;$i_day<$num_dayShow;$i_day++){
                    ?>
                      <tr>
                        <td align="center" valign="middle" height="50" class="day_schedule" bgcolor="#101010">
                        <div class="day_schedule_text">
                            <font color="#DCDCDC" size="3"><?=$thai_day_arr[$i_day]?></font>
                            <br>

                        </div>
                        </td>
                    <?php for($i_time=0;$i_time<$sc_numCol-1;$i_time++){sleep(0.1);?>
                      <?php $check=false ?>
                      <?php foreach ($Table as $Tables): sleep(0.1);?>
                        <?php if ($Tables->roomID == $Room->roomID && $Tables->Day == $eng_day_arr[$i_day] && $Tables->TableStart == "$sc_timeStep[$i_time]:00"): ?>
                          <td align="center" valign="middle" height="50" bgcolor="#B92000"></td>
                          <?php $check=true; break;?>
                        <?php endif; ?>
                      <?php endforeach; ?>
                      <?php if (!$check): ?>
                        <td align="center" valign="middle" height="50" bgcolor="#FFFFFF"></td>
                      <?php endif; ?>
                    <?php  }?>
                      </tr>
                    <?php }?>
                    </table>
                </div>
                <!-- ////////////////////// ส่วนของตาราง //////////////// -->
          <br>
                @foreach($Rsroom as $Rsrooms)
                        @if($Rsrooms->RsroomName == $Room->roomName)
                          <div class="table-responsive table-inverse transition visible" id="table" style="display: block !important;">
                              <table class="table table-bordered" id="border">
                                <tbody><tr>
                                </tr></tbody><thead>
                                  <tr><th class="bg-primary">Date</th>
                                  <th class="bg-primary">Use Time</th>
                                  <th class="bg-primary">Status</th>
                                </tr>
                                </thead>
                                      <tbody>
                                      <tr>
                                           <td class="bg-warning"><font size="3">{{$Rsrooms->RsDate}}<font color="red">** </font> </font></td>
                                           <td class="bg-warning"><font size="3">{{$Rsrooms->RsStart}} - {{$Rsrooms->RsEnd}}</font></td>
                                           <td class="bg-warning">
                                          <img width="12" height="12" src="{{ asset('/img/demo/circlewaiting.png') }">&nbsp;<font size="3" color="red">รอใช้งาน</font>
                                     </td>

                                      </tr>
                                    </tbody>
                                    </table>
                            </div>
                        @endif
                @endforeach
          <font>สีแดงคือเวลาที่ไม่สามารถจองได้</font>
          <br>

          <br>
          <br>
          <div class="table-responsive table-inverse transition visible" id="table" style="display: block !important;">
              <table class="table table-bordered" id="border">
                <tbody><tr>
                </tr></tbody><thead>
                  <tr><th class="bg-primary">Date</th>
                  <th class="bg-primary">Use Time</th>
                  <th class="bg-primary">Status</th>
                </tr>
                </thead>
          @foreach($Rsroom as $Rsrooms)
          @if($Room->roomID == $Rsrooms->roomID)
                  <tbody>
                  <tr>
                   <td class="bg-warning"><font size="3"><?php echo substr($Rsrooms->RsStart, 0 ,10); ?><font color="red">** </font> </font></td>
                   <td class="bg-warning"><font size="3"><?php echo substr($Rsrooms->RsStart, 11 ,9); ?> - <?php echo substr($Rsrooms->RsEnd, 11 ,9); ?></font></td>
                   <td class="bg-warning">
                  <img width="12" height="12" src="{{ asset('/img/demo/circlewaiting.png') }}">&nbsp;<font size="3" color="red">รอใช้งาน</font>
                  </td>
                  </tr>
                  </tbody>
          @endif
          @endforeach
                    </table>
            </div>
        </div>
      </div>

    <center>
    <div class="navbar-fixed-bottom" id="para2" style="display: block;">
        <i class="wizard icon"></i>
        <font size="2"> Powered by CPE-KUSRC © 2018</font>
    </div>
    </center>
    <!-- Scripts -->
    <script src="{{ asset('/js/semantic.min.js') }}"></script>
    <script>
        function goBack() {
            window.history.back();
        }
    </script>
</div>
</body>
</html>
