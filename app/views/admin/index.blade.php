@extends('layouts/principal')

@section('title')
<title>Garden Central | Administración</title>
@show

@section('username')
<span class="glyphicon glyphicon-user"></span>
<strong> Bienvenido: {{ Auth::user()->usuario }} </strong>
@stop

@section('content')
<div class="content">
  <div class="row contenido-principal">
      <div class="col-sm-8 main-content">
              @include('layouts/inc/estatus')
              <h2>Pending Deals
                  <span class="info">You have 15 deals that will be closing soon.</span>
              </h2>
              <ul class="item-summary">



                  <li>
                      <div class="overview">
                          <p class="main-detail">April 14th</p>
                          <p class="sub-detail">5:28 PM</p>
                          <span class="label label-success">Active</span> <span class="label label-info">New</span>
                      </div>
                      <div class="info">
                          <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                          <a class="btn btn-default btn-sm" href="#">Show Details</a>
                      </div>
                      <div class="clearfix"></div>
                  </li>

                  <li>
                      <div class="overview">
                          <p class="main-detail">Jan 24th</p>
                          <p class="sub-detail">2:57 PM</p>
                          <span class="label label-success">Active</span>
                      </div>
                      <div class="info">
                          <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                          <a class="btn btn-default btn-sm" href="#">Show Details</a>
                      </div>
                      <div class="clearfix"></div>
                  </li>

                  <li>
                      <div class="overview">
                          <p class="main-detail">May 9th</p>
                          <p class="sub-detail">11:9 PM</p>
                          <span class="label label-success">Active</span>
                      </div>
                      <div class="info">
                          <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                          <a class="btn btn-default btn-sm" href="#">Show Details</a>
                      </div>
                      <div class="clearfix"></div>
                  </li>

                  <li>
                      <div class="overview">
                          <p class="main-detail">June 3rd</p>
                          <p class="sub-detail">1:30 PM</p>
                          <span class="label label-success">Active</span>
                      </div>
                      <div class="info">
                          <p>Trust fund photo letterpress, keytar raw skydiving denim grape keffiyeh etsy art base apple party ball before they.</p>
                          <a class="btn btn-default btn-sm" href="#">Show Details</a>
                      </div>
                      <div class="clearfix"></div>
                  </li>

              </ul>

              <div id="three-summaries" class="row">
                  <div class="col-md-5">
                      <h2>Mailboxes</h2>
                      <ul class="list-group">
                          <li class="list-group-item"><span class="glyphicon glyphicon-envelope"></span> New<span class="badge badge-important">23</span></li>
                          <li class="list-group-item"><span class="glyphicon glyphicon-folder-open"></span> Follow Up<span class="badge badge-important">13</span></li>
                          <li class="list-group-item"><span class="glyphicon glyphicon-star-empty"></span> Starred<span class="badge badge-important">73</span></li>
                          <li class="list-group-item"><span class="glyphicon glyphicon-list-alt"></span> All Messages<span class="badge badge-important">89</span></li>
                          <li class="list-group-item"><span class="glyphicon glyphicon-bookmark"></span> Archived<span class="badge badge-important">24</span></li>
                          <li class="list-group-item"><span class="glyphicon glyphicon-thumbs-up"></span> Important<span class="badge badge-important">10</span></li>
                          <li class="list-group-item"><span class="glyphicon glyphicon-envelope"></span> Personal<span class="badge badge-important">39</span></li>
                      </ul>
                  </div>

                  <div class="col-md-7">
                      <h2>Upcoming Events</h2>
                      <ul class="cards list-group widget" style="border-bottom:0px;">



                          <li class="list-group-item">
                              <button class="btn btn-default pull-right btn-sm" style="margin-top: .8em;">Open</button>
                              <i class="pull-left muted glyphicon glyphicon-stats" style="margin-top:.3em;"></i>
                              <div>
                                  <p class="title"> Campaign Ends</p>
                                  <p class="info">Saturday, July 22nd 12:45PM</p>
                              </div>
                          </li>

                          <li class="list-group-item">
                              <button class="btn btn-default pull-right btn-sm" style="margin-top: .8em;">Open</button>
                              <i class="pull-left muted glyphicon glyphicon-user" style="margin-top:.3em;"></i>
                              <div>
                                  <p class="title"> User Training</p>
                                  <p class="info">Saturday, July 22nd 12:45PM</p>
                              </div>
                          </li>

                          <li class="list-group-item">
                              <button class="btn btn-default pull-right btn-sm" style="margin-top: .8em;">Open</button>
                              <i class="pull-left muted glyphicon glyphicon-time" style="margin-top:.3em;"></i>
                              <div>
                                  <p class="title"> Free Trial Ends</p>
                                  <p class="info">Saturday, July 22nd 12:45PM</p>
                              </div>
                          </li>

                          <li class="list-group-item">
                              <button class="btn btn-default pull-right btn-sm" style="margin-top: .8em;">Open</button>
                              <i class="pull-left muted glyphicon glyphicon-gift" style="margin-top:.3em;"></i>
                              <div>
                                  <p class="title"> User Appreciation Day</p>
                                  <p class="info">Saturday, July 22nd 12:45PM</p>
                              </div>
                          </li>

                          <li class="list-group-item">
                              <button class="btn btn-default pull-right btn-sm" style="margin-top: .8em;">Open</button>
                              <i class="pull-left muted glyphicon glyphicon-plane" style="margin-top:.3em;"></i>
                              <div>
                                  <p class="title"> Flight Training</p>
                                  <p class="info">Saturday, July 22nd 12:45PM</p>
                              </div>
                          </li>

                      </ul>
                  </div>
              </div>

                      <h2>Inbox</h2>

                      <table class="table table-first-column-check table-hover">
                          <thead>
                              <tr>
                                <th class="col-md-1"><span class=" glyphicon glyphicon-star-empty"></span></th>
                                <th class="col-md-2">From</th>
                                <th class="col-md-8">Subject</th>
                                <th class="col-md-3">Date</th>
                              </tr>
                          </thead>
                          <tbody>
                              <tr>
                                <td><a href="#"><span class=" glyphicon glyphicon-star-empty"></span></a></td>
                                <td><strong>John Doe</strong></td>
                                <td><strong>Message body goes in here</strong> <span class="label label-success pull-right" style="margin-left: .5em;">Follow Up </span> <span class="label label-info pull-right">Work</span></td>
                                <td><strong>11:23 PM</strong></td>
                              </tr>
                              <tr>
                                <td><a href="#"><span class=" glyphicon glyphicon-star-empty"></span></a></td>
                                <td>John Doe</td>
                                <td>Message body goes in here <span class="label label-success pull-right">Follow Up</span></td>
                                <td>Sept4</td>
                              </tr>
                              <tr>
                                <td><a href="#"><span class="glyphicon glyphicon-star"></span></a></td>
                                <td><strong>John Doe</strong></td>
                                <td><strong>Message body goes in here</strong> <span class="label label-important pull-right">Spam</span></td>
                                <td><strong>Sept3</strong></td>
                              </tr>
                              <tr>
                                <td><a href="#"><span class="glyphicon glyphicon-star"></span></a></td>
                                <td><strong>John Doe</strong></td>
                                <td> <strong>Message body goes in here</strong> <span class="label pull-right">Personal</span></td>
                                <td><strong>Sept3</strong></td>
                              </tr>
                          </tbody>
                      </table>

                      <h2>Top Users</h2>
                      <div class="well widget" style="display: none;">
                          <form class="form-inline" style="margin-bottom: 0px;">
                              <input class="input-xlarge" placeholder="Search All Users..." type="text">
                              <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span> Go</button>
                          </form>
                      </div>
                      <table class="table table-first-column-check">
                        <thead>
                          <tr>
                            <th><input type="checkbox"></th>
                            <th>First</th>
                            <th>Last</th>
                            <th>Username</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td>Mark</td>
                            <td>Tompson</td>
                            <td>the_mark7</td>
                          </tr>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td>Ashley</td>
                            <td>Jacobs</td>
                            <td>ash11927</td>
                          </tr>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td>Audrey</td>
                            <td>Ann</td>
                            <td>audann84</td>
                          </tr>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td>John</td>
                            <td>Robinson</td>
                            <td>jr5527</td>
                          </tr>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td>Aaron</td>
                            <td>Butler</td>
                            <td>aaron_butler</td>
                          </tr>
                          <tr>
                            <td><input type="checkbox"></td>
                            <td>Chris</td>
                            <td>Albert</td>
                            <td>cab79</td>
                          </tr>
                        </tbody>
                      </table>
          </div>

      <div class="col-sm-4 sidebar">
          <div class="widget">
              <h2>Latest Comments</h2>
              <ul class="cards list-group">
                  <li class="list-group-item">
                      <p class="title">Ashley Jacobs</p>
                      <div class="img">
                          <img src="img/1a.png">
                          <div class="label label-info">Pro</div>
                      </div>
                      <p class="info-text">Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid.</p>
                      <div class="stats">
                          <p class="time">5 minutes ago</p>
                          <span>15 <span class="glyphicon glyphicon-pushpin"></span></span>
                          <span>27 <span class="glyphicon glyphicon-comment"></span></span>
                          <span>158 <span class="glyphicon glyphicon-eye-open"></span></span>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <p class="title">Sarah Whitman</p>
                      <div class="img">
                          <img src="img/1a.png">
                          <div class="label label-warning">Free</div>
                      </div>
                      <p class="info-text">Trust fund seitan letterpress, keytar raw denim keffiyeh etsy art party before they sold out master.</p>
                      <div class="stats">
                          <p class="time">29 minutes ago</p>
                          <span>10 <span class="glyphicon glyphicon-pushpin"></span></span>
                          <span>19 <span class="glyphicon glyphicon-comment"></span></span>
                          <span>58 <span class="glyphicon glyphicon-eye-open"></span></span>
                      </div>
                  </li>
                  <li class="list-group-item">
                      <p class="title">Connor Adams</p>
                      <div class="img">
                          <img src="img/1a.png">
                          <div class="label label-info">Pro</div>
                      </div>
                      <p class="info-text">Anderson tofu before they sold out mcsweeney's organic lomo retro fanny pack.</p>
                      <div class="stats">
                          <p class="time">Yesterday</p>
                          <span>25 <i class="icon-pushpin"></i></span>
                          <span>39 <i class="icon-comment"></i></span>
                          <span>252 <i class="icon-eye-open"></i></span>
                      </div>
                  </li>
                  <li class="more">
                      <a href="#">Show All</a>
                  </li>
              </ul>
          </div>
          <div class="widget">
              <ul id="myTab" class="nav nav-tabs three-tabs fancy">
                <li class="active"><a href="#home" data-toggle="tab">Orders</a></li>
                <li><a href="#promotions" data-toggle="tab">Promotions</a></li>
                <li class="dropdown">
                  <a href="#deals" data-toggle="tab">Deals</a>
                </li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="home">
                <ul class="list-group cards">
                  <li class="list-group-item">
                      <p class="pull-right text-error">$20,500</p>
                      <a href="#"><p class="title">Care Hospital</p></a>
                      <p class="info">Sales Rating: 86%</p>
                  </li>
                  <li class="list-group-item">
                      <p class="pull-right text-info">$9,400</p>
                      <a href="#"><p class="title">New Automotive</p></a>
                      <p class="info">Sales Rating: 72%</p>
                  </li>
                  <li class="list-group-item">
                      <p class="pull-right text-success">$60,200</p>
                      <a href="#"><p class="title">Money Financial</p></a>
                      <p class="info">Sales Rating: 92%</p>
                  </li>
                  <li class="list-group-item">
                      <p class="pull-right text-important">$8,640</p>
                      <a href="#"><p class="title">Custom Insurance</p></a>
                      <p class="info">Sales Rating: 84%</p>
                  </li>
                  <li class="list-group-item" style="border-bottom: 0px;">
                      <p class="pull-right text-warning">$36,700</p>
                      <a href="#"><p class="title">New Technology</p></a>
                      <p class="info">Sales Rating: 66%</p>
                  </li>
              </ul>
                </div>
                <div class="tab-pane fade" id="promotions">

                  <ul class="cards">
                      <li style="padding: 0em 1em;"><h3>This is something interesting.</h3></li>
                      <li>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation labore velit, blog sartorial PBR leggings next level wes anderson artisan.</li>
                      <li>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation labore velit, blog sartorial PBR leggings next level wes anderson artisan.</li>
                      <li>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation labore velit, blog sartorial PBR leggings next level wes anderson artisan.</li>
                  </ul>
                </div>
                <div class="tab-pane fade" id="deals">
                  <ul class="cards">
                      <li><p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid oranges apples banana.</p><a class="btn btn-default btn-sm" href="#">Show me</a></li>
                      <li><p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid oranges apples banana.</p><a class="btn btn-default btn-sm" href="#">Show me</a></li>
                      <li><p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid oranges apples banana.</p><a class="btn btn-default btn-sm" href="#">Show me</a></li>
                      <li><p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid oranges apples banana.</p><a class="btn btn-default btn-sm" href="#">Show me</a></li>
                  </ul>
                </div>
              </div>
          </div>

          <div class="widget">
              <ul class="nav nav-tabs two-tabs fancy">
                <li class="active"><a href="#upgrade" data-toggle="tab">Upgrade Account</a></li>
                <li><a href="#why-upgrade" data-toggle="tab">Why Upgrade?</a></li>
              </ul>
              <div class="tab-content">
                <div class="tab-pane fade in active" id="upgrade">

                  <ul class="cards list-group not-bottom no-sides">



                      <li class="list-group-item">
                      <i class="glyphicon glyphicon-leaf pull-left text-info"></i>
                          <p class="title"><strong>More Features</strong></p>
                          <p class="info small">This is the kind of thing you really need.</p>
                      </li>

                      <li class="list-group-item">
                      <i class="glyphicon glyphicon-user pull-left text-info"></i>
                          <p class="title"><strong>Unlimited Users</strong></p>
                          <p class="info small">This is the kind of thing you really need.</p>
                      </li>

                      <li class="list-group-item">
                      <i class="glyphicon glyphicon-glass pull-left text-info"></i>
                          <p class="title"><strong>Custom Database</strong></p>
                          <p class="info small">This is the kind of thing you really need.</p>
                      </li>

                      <li class="list-group-item">
                      <i class="glyphicon glyphicon-book pull-left text-info"></i>
                          <p class="title"><strong>Enhanced Reporting</strong></p>
                          <p class="info small">This is the kind of thing you really need.</p>
                      </li>

                  </ul>
                  <button class="btn btn-primary pull-right" style="margin:1em 0em;">Upgrade Now</button>
                </div>
                <div class="tab-pane fade" id="why-upgrade">
                  <h3>This is something interesting.</h3>
                  <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation labore velit, blog sartorial PBR leggings next level wes anderson artisan.</p>
                  <button class="btn btn-primary pull-right" style="margin-bottom: 1em;">Upgrade Now</button>
                </div>
              </div>
          </div>
      </div>
  </div>
</div>
@stop

