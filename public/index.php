<html ng-app="planner">
<head>
    <title>MeetUp Planner</title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/master.css" type="text/css">
</head>
<body ng-controller="MainController" ng-cloak>
    <div class="container">
        <div class="row row-centered planner-block">
            <div class="col-md-12">
                <div class="col-md-5 col-centered form-area">
                    <div class="row row-centered">
						<div class="col-md-11 col-centered form-planner-inner" ng-show="fsVal">
					        <span class="form-text">Meet-Up Event Planner</span>
					        <hr class="seperator"/>
					        <h3>Sign Up</h3>
					        <form name="signup" ng-submit="validate(userInfo);" onsubmit="return false;">
					            <div class="form-group">
									<input aria-label="Full Name" type="textfield" class="form-control" ng-required="true" name="fname" placeholder="Full Name" autofocus ng-minlength="2" ng-model="userInfo.name"/>  
					                <span ng-show="signup.fname.$touched && signup.fname.$invalid"><br></span>
					                <div class="alert alert-danger" role="alert" ng-show="signup.fname.$touched && signup.fname.$invalid">
					                    Please enter a valid name
					                </div>
					            </div>
					            <div class="form-group">
								<input aria-label="E-mail Address" type="email" class="form-control" ng-required="true" name="email" placeholder="E-mail Address" ng-pattern="/^[_a-z0-9]+(\.[_a-z0-9]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,4})$/" ng-model="userInfo.email"/>
					                <span ng-show="signup.email.$touched && signup.email.$invalid"><br></span>
					                <div class="alert alert-danger" role="alert" ng-show="signup.email.$touched && signup.email.$invalid">
					                    Please enter a valid email address
					                </div>
					            </div>
					            <div class="form-group">
					                <input aria-label="Password" name="password" type="password" class="form-control" placeholder="Password (8 characters atleast)" ng-required="true" ng-model="userInfo.password" ng-minlength="8">
					                <span ng-show="signup.password.$touched && signup.password.$invalid"><br></span>
					                <div class="alert alert-danger" role="alert" ng-show="signup.password.$touched && signup.password.$invalid">
					                    Enter a password of at least 8 chars
					                </div>
					            </div>
								<table class="optional-table" border="0">
						            <tr>
						                <th>Birthday</th>
						                <th>Job Title</th>
						            </tr>
						            <tr>
						                <td>
						                    <div class="form-group">
						                        <input aria-label="Birth Date" type="date" value="1990-01-01" name="bdate" class="form-control">
						                    </div>
						                </td>
						                <td>
						                    <div class="form-group">
												<input aria-label="Job Title" list="jtitle" class="form-control" placeholder="What do you do?">
													<datalist id="jtitle">
														<option value="Student"></option>
														<option value="Application Developer"></option>
														<option value="Web Developer"></option>
														<option value="Architect"></option>
														<option value="Senior Manager"></option>
														<option value="Financial Advisor"></option>
														<option value="Lawyer"></option>
														<option value="Big Data"></option>
														<option value="Manager"></option>
														<option value="CEO"></option>
														<option value="Q/A"></option>
														<option value="Promotional Manager"></option>
													</datalist>
						                    </div>
						                </td>
						            </tr>
								</table>
					            <div class="form-group">
					                <span ng-show="signup.$invalid">or <u>Log In</u></span>
					                <input aria-label="submit" type="submit" name="submit" value="Let's create an event {{ userInfo.name | lowercase }}!" class="form-control btn btn-primary" ng-show="signup.$valid" id="su-submit"/>
					            </div>
					        </form>
					    </div>
					    <div class="col-md-11 col-centered form-planner-inner ev-c" id="eventsSec">
					        <span class="form-text">Meet-Up Event Planner</span>
					        <hr class="seperator"/>
					        <h3>Create Event</h3>
							<div ng-if="evVal == true" ng-init="callFocus()"></div>
					        <form form-autofill-fix name="planner" ng-submit="validatePlanner(userPlannerInfo);" onsubmit="return false;">
					        <div class="form-group">
					            <input aria-label="Event Name" type="textfield" class="form-control" id="ev-create" ng-required="true" name="ename" placeholder="Event Name" ng-minlength="2" ng-model="userPlannerInfo.eventName"/>
								<span ng-show="planner.ename.$touched && planner.ename.$invalid"><br></span>
					            <div class="alert alert-danger" role="alert" ng-show="planner.ename.$touched && planner.ename.$invalid">
					                Please enter a valid event name
					            </div>
					        </div>
					        <div class="form-group">
					            <input aria-label="Event Host" type="textfield" class="form-control" ng-required="true" name="ehost" placeholder="Event Host (Individual/Organization)" autofocus ng-minlength="2" ng-model="userPlannerInfo.eventHost"/>
					            <span ng-show="planner.ehost.$touched && planner.ehost.$invalid"><br></span>
					            <div class="alert alert-danger" role="alert" ng-show="planner.ehost.$touched && planner.ehost.$invalid">
					                Please enter a valid event host
					            </div>
					        </div>
					        <div class="form-group">
					            <input aria-label="Event Type" list="events" ng-model="userPlannerInfo.eList" name="eventList" ng-required="true" ng-minlength="3" placeholder="Type of Event" class="form-control">
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
					            <span ng-show="planner.eventList.$touched && planner.eventList.$invalid"><br></span>
					            <div class="alert alert-danger" role="alert" ng-show="planner.eventList.$touched && planner.eventList.$invalid">
					                Please enter a valid event host
					            </div>
					        </div>
					        <div class="form-group">
					            <input aria-label="Event Location" type="text" name="location" placeholder="Where's the event at?" ng-required="true" ng-model="userPlannerInfo.geo" onfocus="geolocate()" id="autocomplete" class="form-control">
								<span ng-show="planner.location.$touched && planner.location.$invalid"><br></span>
					            <div class="alert alert-danger" role="alert" ng-show="planner.location.$touched && planner.location.$invalid">
					                Please enter a valid location
					            </div>
								<span ng-show="(planner.sdate.$touched && planner.sdate.$invalid) || (planner.edate.$touched && planner.edate.$invalid)"><br></span>
								<div class="alert alert-danger" role="alert" ng-show="(planner.sdate.$touched && planner.sdate.$invalid) || (planner.edate.$touched && planner.edate.$invalid)">
					                Please enter a valid date range
					            </div>
								<span ng-show="(planner.stime.$touched && planner.stime.$invalid) || (planner.etime.$touched && planner.etime.$invalid)"><br></span>
								<div class="alert alert-danger" role="alert" ng-show="(planner.stime.$touched && planner.stime.$invalid) || (planner.etime.$touched && planner.etime.$invalid)">
					                Please enter a valid time range
					            </div>
					            <!--<input type="text" name="locationThrow" id="locationThrow" ng-required="true" ng-minlength="5"  ng-model="userPlannerInfo.geo">-->
					        </div>
							<?php
								$date = new \DateTime();
							?>
					        <table class="event-table" border="0">
					            <tr>
					                <th>Starts on</th>
					                <th>Ends on</th>
					            </tr>
					            <tr>
					                <td>
					                    <div class="form-group">
					                        <input aria-label="Start Date" type="date" ng-model="sdate" min="<?php echo date('Y-m-d'); ?>" name="sdate" ng-init="sdate='<?php echo date('Y-m-d'); ?>'" class="form-control" value="<?php echo date('Y-m-d'); ?>">
					                    </div>
					                </td>
					                <td>
					                    <div class="form-group">
					                        <input aria-label="End Date" type="date" ng-model="edate" min="{{ sdate }}" name="edate" ng-init="edate='<?php echo date('Y-m-d'); ?>'" class="form-control" value="<?php echo date('Y-m-d'); ?>">
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
					                        <input aria-label="Start Time" type="time" ng-blur="vald()" ng-focus="vald()" ng-change="vald()" ng-model="stime" required name="stime" min="<?php echo date_format($date, 'H:i'); ?>" ng-init="stime='<?php echo date_format($date, 'H:i'); ?>'" class="form-control" value="<?php echo date_format($date, 'H:i'); ?>">
					                    </div>
					                </td>
					                <td>
					                    <div class="form-group">
					                        <input aria-label="End Time" type="time" ng-blur="vald()" ng-focus="vald()" ng-change="vald()" ng-model="etime" required name="etime" min="<?php $min=date_format($date, 'H:i'); $timestamp = strtotime($min) + 60*60; echo date('H:i', $timestamp); ?>" ng-init="etime='<?php $min=date_format($date, 'H:i'); $timestamp = strtotime($min) + 60*60; echo date('H:i', $timestamp); ?>'" class="form-control" value="<?php $min=date_format($date, 'H:i'); $timestamp = strtotime($min) + 60*60; echo date('H:i', $timestamp); ?>">
					                    </div>
					                </td>
					            </tr>
					        </table>
					        <div class="form-group">
								<textarea aria-label="Guest List" class="form-control" placeholder="Guest List (Seperated by comma)" ng-required="true" ng-minlength="2" ng-model="userPlannerInfo.gList" name="glist" cols="50" rows="5"></textarea>
								<span ng-show="planner.glist.$touched && planner.glist.$invalid"><br></span>
					            <div class="alert alert-danger" role="alert" ng-show="planner.glist.$touched && planner.glist.$invalid">
					                Please provide a guest(s) list
					            </div>
					        </div>
							<div class="form-group">
								<textarea aria-label="Extra Info" class="form-control" placeholder="Fill in any extra information for your guests" ng-model="userPlannerInfo.gInfo" name="glist" cols="50" rows="5"></textarea>
					        </div>
					        <div class="form-group">
					            <input aria-label="Launch Event" class="btn btn-primary form-control" ng-show="planner.$valid" type="submit" value="Launch My Event">
					        </div>
					        </form>
					    </div>
					    <div class="col-md-11 col-centered event-planner-outer" ng-show="showEvent">
					        <span class="form-text">Launched Events</span>
					        <hr class="seperator"/>
					        <p class="eventNew" align="center" ng-click="redo()"><u>Create New Event</u></p>
					        <div ng-repeat="event in events track by $index" class="eventActive">
					            <span><span class="glyphicon glyphicon-calendar gCalendar" aria-hidden="true"></span><b>{{ event.eventName }}</b> hosted by <b>{{ event.eventHost }}</b></span>
					            <hr/>
					            <table class="table-responsive" border="0">
					                <tr>
					                    <td><span class="glyphicon glyphicon-time" aria-hidden="true"></span></td>
					                    <td><span class="glyphicon glyphicon-tags" aria-hidden="true"></span></td>
					                </tr>
					                <tr>
					                    <td width="65%">{{ event.eventSDate | date }}, {{ event.eventSTime | date: "h:mm a" }} - {{ event.eventEDate | date }}, {{ event.eventETime | date: "h:mm a" }}</td>
					                    <td>{{ event.eventType }}</td>
					                </tr>
					            </table>
					            <br>
					            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#guestModal-{{ $index }}">View Guest List</button>
					            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#guestModalInfo-{{ $index }}">About The Event</button>
					            <br>
					            <span class="loc"><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> &nbsp;{{ event.eventLoc }}</span>
					            <div class="modal fade" id="guestModal-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					                <div class="modal-dialog" role="document">
					                    <div class="modal-content">
					                        <div class="modal-header">
					                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                            <h4 class="modal-title" id="guestModalLabel">Guest(s) List</h4>
					                        </div>
					                        <div class="modal-body">
					                            {{ event.eventGuest }}
					                        </div>
					                        <div class="modal-footer">
					                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                        </div>
					                    </div>
					                </div>
					            </div>
								 <div class="modal fade" id="guestModalInfo-{{ $index }}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
					                <div class="modal-dialog" role="document">
					                    <div class="modal-content">
					                        <div class="modal-header">
					                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					                            <h4 class="modal-title" id="guestModalLabel">About The Event</h4>
					                        </div>
					                        <div class="modal-body">
					                            {{ event.eventGInfo }}
					                        </div>
					                        <div class="modal-footer">
					                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					                        </div>
					                    </div>
					                </div>
					            </div>

					        </div>
					    </div>

					</div>
                </div>
            </div>
        </div>
    </div>
<script src="js/master.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDDRiA4O1OZ6TeevNNNQUOOCW5uxTZNb-s&libraries=places&callback=initAutocomplete" async defer></script>
</body>
</html>