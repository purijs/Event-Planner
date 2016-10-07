@extends('master')

@section('signup')
    <div class="col-md-11 col-centered form-planner-inner" ng-show="fsVal">
        <span class="form-text">Meet-Up Event Planner</span>
        <hr class="seperator"/>
        <h3>Sign Up</h3>
        {!! Form::open(['name'=>'signup','ng-submit'=>'validate(userInfo);','onsubmit'=>'return false;']) !!}
            <div class="form-group">
                {!! Form::text('fname',null,['class'=>'form-control','placeholder'=>'Full Name',
                'ng-required'=>'true','autofocus','ng-minlength'=>'2','ng-model'=>'userInfo.name']) !!}
                <span ng-show="signup.fname.$dirty && signup.fname.$error.required"><br></span>
                <div class="alert alert-danger" role="alert" ng-show="signup.fname.$dirty && signup.fname.$error.required">
                    Please enter a valid name
                </div>
            </div>
            <div class="form-group">
                {!! Form::email('email',null,['class'=>'form-control','placeholder'=>'E-mail Address','ng-required'=>'true',
                'ng-pattern'=>'/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/','ng-model'=>'userInfo.email']) !!}
                <span ng-show="signup.email.$dirty && signup.email.$error.required"><br></span>
                <div class="alert alert-danger" role="alert" ng-show="signup.email.$error.required && signup.email.$dirty">
                    Please enter a valid email address
                </div>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" placeholder="Password (8 characters atleast)" ng-required="true" ng-model="userInfo.password" ng-minlength="8">
                <span ng-show="signup.password.$dirty && signup.password.$error.required"><br></span>
                <div class="alert alert-danger" role="alert" ng-show="signup.password.$error.required && signup.password.$dirty">
                    Enter a password of at least 8 chars
                </div>
            </div>
            <div class="form-group">
                <span ng-show="signup.$invalid">or <u>Log In</u></span>
                {!! Form::submit("Let's create an event @{{ userInfo.name | lowercase }}!",['class'=>'btn btn-primary form-control','ng-show'=>'signup.$valid']) !!}
            </div>
        {!! Form::close() !!}
    </div>
@stop

@section('event')
    <div class="col-md-11 col-centered form-planner-inner" ng-show="evVal">
        <span class="form-text">Meet-Up Event Planner</span>
        <hr class="seperator"/>
        <h3>Create Event</h3>
        {!! Form::open(['form-autofill-fix','name'=>'planner','ng-submit'=>'validatePlanner(userPlannerInfo);','onsubmit'=>'return false;']) !!}
        <div class="form-group">
            {!! Form::text('ename',null,['class'=>'form-control','placeholder'=>'Event Name',
            'ng-required'=>'true','autofocus','ng-minlength'=>'2','ng-model'=>'userPlannerInfo.eventName']) !!}
            <span ng-show="planner.ename.$dirty && planner.ename.$error.required"><br></span>
            <div class="alert alert-danger" role="alert" ng-show="planner.ename.$dirty && planner.ename.$error.required">
                Please enter a valid event name
            </div>
        </div>
        <div class="form-group">
            {!! Form::text('ehost',null,['class'=>'form-control','placeholder'=>'Event Host (Individual/Organization)',
            'ng-required'=>'true','ng-minlength'=>'2','ng-model'=>'userPlannerInfo.eventHost']) !!}
            <span ng-show="planner.ehost.$dirty && planner.ehost.$error.required"><br></span>
            <div class="alert alert-danger" role="alert" ng-show="planner.ehost.$dirty && planner.ehost.$error.required">
                Please enter a valid event host
            </div>
        </div>
        <div class="form-group">
            <input list="events" ng-model="userPlannerInfo.eList" name="eventList" ng-required="true" ng-minlength="3" placeholder="Type of Event" class="form-control">
            <datalist id="events">
                <option value="Conference"></option>
                <option value="Birthday Party"></option>
                <option value="Business Meeting"></option>
                <option value="Business Dinner"></option>
                <option value="Seminar"></option>
                <option value="Networking Event"></option>
                <option value="Wedding"></option>
                <option value="Family Event"></option>
            </datalist>
            <span ng-show="planner.eventList.$dirty && planner.eventList.$error.required"><br></span>
            <div class="alert alert-danger" role="alert" ng-show="planner.eventList.$dirty && planner.eventList.$error.required">
                Please enter a valid event host
            </div>
        </div>
        <div class="form-group">
            <input type="text" name="location" placeholder="Where's the event at?" ng-required="true" ng-model="userPlannerInfo.geo" onfocus="geolocate()" id="autocomplete" class="form-control">
            <!--<input type="text" name="locationThrow" id="locationThrow" ng-required="true" ng-minlength="5"  ng-model="userPlannerInfo.geo">-->
        </div>
        <table class="event-table" border="0">
            <tr>
                <th>Starts on</th>
                <th>Ends on</th>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <input type="date" ng-model="sdate" min="{{ date('Y-m-d') }}" required name="sdate" ng-init="sdate='{{ date('Y-m-d',time()+86400) }}'" class="form-control" value="{{ date('Y-m-d',time()+86400) }}">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="date" ng-model="edate" min="{{ date('Y-m-d') }}" required name="edate" ng-init="edate='{{ date('Y-m-d',time()+86400) }}'" class="form-control" value="{{ date('Y-m-d',time()+86400) }}">
                    </div>
                </td>
            </tr>
            <tr>
                <th>At</th>
                <th>At</th>
            </tr>
            <tr>
                <td>
                    <div class="form-group">
                        <input type="time" ng-model="stime" required name="sdatetime" ng-init="stime='09:00'" class="form-control" value="09:00">
                    </div>
                </td>
                <td>
                    <div class="form-group">
                        <input type="time" ng-model="etime" required name="sdatetime" ng-init="etime='23:00'" class="form-control" value="23:00">
                    </div>
                </td>
            </tr>
        </table>
        <div class="form-group">
            {!! Form::textarea('glist',null,['class'=>'form-control','placeholder'=>'Guest List (Seperated by comma)',
            'ng-required'=>'true','ng-minlength'=>'2','ng-model'=>'userPlannerInfo.gList']) !!}
        </div>
        <div class="form-group">
            {!! Form::submit("Launch My Event",['class'=>'btn btn-primary form-control','ng-show'=>'planner.$valid']) !!}
        </div>
        {!! Form::close() !!}
    </div>
@stop

@section('displayEvents')
    <div class="col-md-11 col-centered event-planner-outer" ng-show="showEvent">
        <span class="form-text">Launched Events</span>
        <hr class="seperator"/>
        <p class="eventNew" align="center" ng-click="redo()"><u>Create New Event</u></p>
        <div ng-repeat="event in events track by $index" class="eventActive">
            <span><span class="glyphicon glyphicon-calendar gCalendar" aria-hidden="true"></span><b>@{{ event.eventName }}</b> hosted by <b>@{{ event.eventHost }}</b></span>
            <hr/>
            <table class="table-responsive" border="0">
                <tr>
                    <td><span class="glyphicon glyphicon-time" aria-hidden="true"></span></td>
                    <td><span class="glyphicon glyphicon-tags" aria-hidden="true"></span></td>
                </tr>
                <tr>
                    <td width="65%">@{{ event.eventSDate | date }}, @{{ event.eventSTime | date: "h:mm a" }} - @{{ event.eventEDate | date }}, @{{ event.eventETime | date: "h:mm a" }}</td>
                    <td>@{{ event.eventType }}</td>
                </tr>
            </table>
            <br>
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#guestModal-@{{ $index }}">View Guest List</button>
            <br>
            <span class="loc"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> &nbsp;@{{ event.eventLoc }}</span>
            <div class="modal fade" id="guestModal-@{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title" id="guestModalLabel">Guest(s) List</h4>
                        </div>
                        <div class="modal-body">
                            @{{ event.eventGuest }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@stop
