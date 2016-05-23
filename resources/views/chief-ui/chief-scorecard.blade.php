@extends('layout-chief')
@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/chief_scorecard.js') }}"></script>


      <style type="text/css">
        /* Component styles */




th {
    padding: 0.5em 0.70em 0.5em 0.5em;
    text-align: center;
    border: 1px solid white;


}

.thlast{
    padding-left: 0.8em;
}

.thowner{
    padding-left: 2.1em;
}



 
 
tbody tr:nth-child(2n-1) {
    background-color: #f5f5f5;
    transition: all 5s ease-in-out;
}
tbody tr:hover {
    background-color: rgba(129,208,177,.3);
}

/* For appearance */
.sticky-wrap {
    overflow-x: auto;
    overflow-y: hidden;
    position: relative;
    margin: 3em 0;
    width: 100%;
}
.sticky-wrap .sticky-thead,
.sticky-wrap .sticky-col,
.sticky-wrap .sticky-intersect {
    opacity: 0;
    position: absolute;
    top: 0;
    left: 0;
    transition: all .125s ease-in-out;
    z-index: 50;
    width: auto; /* Prevent table from stretching to full size */
}
    .sticky-wrap .sticky-thead {
        box-shadow: 0 0.25em 0.1em -0.1em rgba(0,0,0,.125);
        z-index: 100;
        width: 50px; /* Force stretch */
    }
    .sticky-wrap .sticky-intersect {
        opacity: 1;
        z-index: 150;

    }
        .sticky-wrap .sticky-intersect th {
            background-color: #666;
            color: #eee;
        }
.sticky-wrap td,
.sticky-wrap th {
    box-sizing: border-box;
}

/* Not needed for sticky header/column functionality */
td.user-name {
    text-transform: capitalize;
}
.sticky-wrap.overflow-y {
    overflow-y: auto;
    max-height: 50vh;
}


}
    </style>


    <div ng-app="unitScorecardApp" ng-controller="APIChiefScorecardController">
        <div id="wrap">
            <div class="row">
                <div class="panel panel-info scorecard-custom-panel">
                        <div class="panel-heading scorecard-custom-heading">
                            <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/chiefpictures/cropped/'.''.$chief_user->chief->PicturePath.'') }}">
                          
                            <h2 class="heading">
                                <b>{{ $chief_user->chief->ChiefAbbreviation }} Scorecard for {{ date("Y") }}
                                </b>
                                <div class="col-md-3 pull-right">
                                    <a href="/">
                                        <button type="button" class="btn btn-warning btn-sm pull-right" ><i class="fa fa-save fa-fw"></i>Generate Report</button>
                                    </a> 
                                </div>
                            </h2>   
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                        </div><!--div panel-heading-->

                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th rowspan="2">
                                            <input type="text" class="scorecard-objectives" value="OBJECTIVES" disabled/>
                                        </th>
                                
                                        <th colspan="4">
                                            MEASURES
                                        </th>


                                        <th rowspan="2" class="thowner">
                                            <input type="text" class="scorecard-owner" value="OWNER" disabled/>
                                        </th>

                                        <th colspan="12">
                                            TARGET/ACCOMPLISHMENT
                                        </th>

                                        <th rowspan="2">
                                             <input type="text" class="scorecard-initiatives" value="INITIATIVES" disabled/>
                                        </th>
                                        <th colspan="3">
                                            FUNDING
                                        </th>
                                        <th rowspan="2" class="thlast">
                                            <input type="text" class="scorecard-action" value="Action" disabled/>
                                        </th>
                                    </tr>

                                    <tr>
                                        <th colspan="2">
                                            <input type="text" class="scorecard-name" value="Name" disabled/>
                                        </th>

                                        <th>
                                            LG
                                        </th>
                                        <th>
                                            LD
                                        </th>
                                       

                                        <th>
                                            <input type="text" class="scorecard-month" value="January" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-month" value="February" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-month" value="March" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-month" value="April" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-month" value="May" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-month" value="June" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-month" value="July" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-month" value="August" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-month" value="September" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-month" value="October" disabled/>
                                        </th>
                                        <th>
                                            <input type="text"  class="scorecard-month" value="November" disabled/>
                                        </th>
                                        <th>
                                            <input type="text"  class="scorecard-month" value="December" disabled/>
                                        </th>
                                        
                                        <th>
                                            <input type="text" class="scorecard-estimate" value="Estimate" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-actual"  value="Actual" disabled/>
                                        </th>
                                        <th>
                                            <input type="text" class="scorecard-variance" value="Variance" disabled/>
                                        </th>
                                    </tr>
                                        
                                    </thead>
                                    <tr ng-repeat='chief_target in chief_targets|filter:search'>
                                        
                                        <td><% chief_target.chief_measure.chief_objective.ChiefObjectiveName %></td>

                                        <td colspan="2"><% chief_target.chief_measure.ChiefMeasureName %><br /><i style="font-size:10px;">Contributory/ies to this Measure</i>
                                            <br /><!--Contributory Accomplishment--><p class="scorecard-minilabel" ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                            <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>
                                        </td>


                                        <input type="hidden" ng-model="chieftype" ng-init="c_type=chief_target.chief_measure.ChiefMeasureType">


                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LD'"></td>
                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LD'"></td>
                                        

                                        <td>
                                            <textarea rows="5" cols="30" id="id_owner<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform"  value="<% chief_target.chief_owner.ChiefOwnerContent %>" ng-model="chief_target.chief_owner.ChiefOwnerContent" autocomplete="off"  required ng-touched></textarea>
                                        </td>

                                        <td><% chief_target.JanuaryTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                /<strong><% staff_measure.staff_accomplishments[0].JanuaryAccomplishment | number: 2 %></strong><span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span></p>

                                        </td>

                                        <td><% chief_target.FebruaryTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                /<strong><% staff_measure.staff_accomplishments[0].FebruaryAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.MarchTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                /<strong><% staff_measure.staff_accomplishments[0].MarchAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.AprilTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].AprilAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.MayTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].MayAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.JuneTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].JuneAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.JulyTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].JulyAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.AugustTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].AugustAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.SeptemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].SeptemberAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.OctoberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].OctoberAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.NovemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].NovemberAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><% chief_target.DecemberTarget | number: 2 %>

                                            <!--Contributory Accomplishment-->
                                            <p ng-repeat='staff_measure in chief_target.chief_measure.staff_measures'>
                                                / <strong><% staff_measure.staff_accomplishments[0].DecemberAccomplishment | number: 2 %></strong> <span class="label label-info"><% staff_measure.staff_accomplishments[0].staff.StaffAbbreviation %></span>
                                            </p>

                                        </td>

                                        <td><textarea rows="5" cols="25" id="id_initiative<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" value="<% chief_target.chief_initiative.ChiefInitiativeContent %>" ng-model="chief_target.chief_initiative.ChiefInitiativeContent" autocomplete="off"  required ng-touched ></textarea></td>

                                        <td><input type='text' id="id_estimate<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" valid-number value="<% chief_target.chief_funding.ChiefFundingEstimate %>" ng-model="chief_target.chief_funding.ChiefFundingEstimate" autocomplete="off" class="form-control" required ng-touched /></td>

                                        <td><input type='text' id="id_actual<%chief_target.chief_measure.ChiefMeasureID%>" name="monthlyform" valid-number value="<% chief_target.chief_funding.ChiefFundingActual %>" ng-model="chief_target.chief_funding.ChiefFundingActual" autocomplete="off" class="form-control" required ng-touched /></td>
                                        
                                        <td><% chief_target.chief_funding.ChiefFundingEstimate - chief_target.chief_funding.ChiefFundingActual | number: 2 %></td>

                                         <input type="hidden" name="ChiefMeasureID" value="<%chief_target.chief_measure.ChiefMeasureID%>" id="chiefmeasure_id<%chief_target.chief_measure.ChiefMeasureID%>" />
                                         <input type="hidden" name="ChiefID" value="<?=$chief_user->chief->ChiefID?>" ng-model="chief_target.ChiefID" id="chief_id<%chief_target.chief_measure.ChiefMeasureID%>" />
                                        <input type="hidden" name="UserChiefID" value="<?=$chief_user->UserChiefID?>" ng-model="chief_target.UserChiefID" id="user_chief_id<%chief_target.chief_measure.ChiefMeasureID%>">
                                        <td>
                                            
                                               <button type="button"  class="btn btn-success btn-sm" id="btn-save" ng-click="save(modalstate, chief_target.ChiefTargetID)"><span class="fa fa-save fa-fw"></span> Save Changes</button>
                                            
                                        </td>
                                    </tr>
                                </table>

                            </div>
                            <!--./table table striped-->
                            <br>
                                 
                            
                        </div><!-- div panel-body-->
                </div><!--div panel panel-info-->
            </div>
        </div>
    </div>


<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-throttle-debounce/1.1/jquery.ba-throttle-debounce.min.js"></script>

<script type="text/javascript">
            

   $(function(){
  $('table').each(function() {
    if($(this).find('thead').length > 0 && $(this).find('th').length > 0) {
      // Clone <thead>
      var $w     = $(window),
        $t     = $(this),
        $thead = $t.find('thead').clone(),
        $col   = $t.find('thead, tbody').clone();

      // Add class, remove margins, reset width and wrap table
      $t
      .addClass('sticky-enabled')
      .css({
        margin: 0,
        width: '100%'
      }).wrap('<div class="sticky-wrap" />');

      if($t.hasClass('overflow-y')) $t.removeClass('overflow-y').parent().addClass('overflow-y');

      // Create new sticky table head (basic)
      $t.after('<table class="sticky-thead" />');

      // If <tbody> contains <th>, then we create sticky column and intersect (advanced)
      if($t.find('tbody th').length > 0) {
        $t.after('<table class="sticky-col" /><table class="sticky-intersect" />');
      }

      // Create shorthand for things
      var $stickyHead  = $(this).siblings('.sticky-thead'),
        $stickyCol   = $(this).siblings('.sticky-col'),
        $stickyInsct = $(this).siblings('.sticky-intersect'),
        $stickyWrap  = $(this).parent('.sticky-wrap');

      $stickyHead.append($thead);

      $stickyCol
      .append($col)
        .find('thead th:gt(0)').remove()
        .end()
        .find('tbody td').remove();

      $stickyInsct.html('<thead><tr><th>'+$t.find('thead th:first-child').html()+'</th></tr></thead>');
      
      // Set widths
      var setWidths = function () {
          $t
          .find('thead th').each(function (i) {
            $stickyHead.find('th').eq(i).width($(this).width());
          })
          .end()
          .find('tr').each(function (i) {
            $stickyCol.find('tr').eq(i).height($(this).height());
          });

          // Set width of sticky table head
          $stickyHead.width($t.width());

          // Set width of sticky table col
          $stickyCol.find('th').add($stickyInsct.find('th')).width($t.find('thead th').width())
        },
        repositionStickyHead = function () {
          // Return value of calculated allowance
          var allowance = calcAllowance();
        
          // Check if wrapper parent is overflowing along the y-axis
          if($t.height() > $stickyWrap.height()) {
            // If it is overflowing (advanced layout)
            // Position sticky header based on wrapper scrollTop()
            if($stickyWrap.scrollTop() > 0) {
              // When top of wrapping parent is out of view
              $stickyHead.add($stickyInsct).css({
                opacity: 1,
                top: $stickyWrap.scrollTop()
              });
            } else {
              // When top of wrapping parent is in view
              $stickyHead.add($stickyInsct).css({
                opacity: 0,
                top: 0
              });
            }
          } else {
            // If it is not overflowing (basic layout)
            // Position sticky header based on viewport scrollTop
            if($w.scrollTop() > $t.offset().top && $w.scrollTop() < $t.offset().top + $t.outerHeight() - allowance) {
              // When top of viewport is in the table itself
              $stickyHead.add($stickyInsct).css({
                opacity: 1,
                top: $w.scrollTop() - $t.offset().top + 55
              });
            } else {
              // When top of viewport is above or below table
              $stickyHead.add($stickyInsct).css({
                opacity: 0,
                top: 0
              });
            }
          }
        },
        repositionStickyCol = function () {
          if($stickyWrap.scrollLeft() > 0) {
            // When left of wrapping parent is out of view
            $stickyCol.add($stickyInsct).css({
              opacity: 1,
              left: $stickyWrap.scrollLeft()
            });
          } else {
            // When left of wrapping parent is in view
            $stickyCol
            .css({ opacity: 0 })
            .add($stickyInsct).css({ left: 0 });
          }
        },
        calcAllowance = function () {
          var a = 0;
          // Calculate allowance
          $t.find('tbody tr:lt(3)').each(function () {
            a += $(this).height();
          });
          
          // Set fail safe limit (last three row might be too tall)
          // Set arbitrary limit at 0.25 of viewport height, or you can use an arbitrary pixel value
          if(a > $w.height()*0.25) {
            a = $w.height()*0.25;
          }
          
          // Add the height of sticky header
          a += $stickyHead.height();
          return a;
        };

      setWidths();

      $t.parent('.sticky-wrap').scroll($.throttle(250, function() {
        repositionStickyHead();
        repositionStickyCol();
      }));

      $w
      .load(setWidths)
      .resize($.debounce(250, function () {
        setWidths();
        repositionStickyHead();
        repositionStickyCol();
      }))
      .scroll($.throttle(250, repositionStickyHead));
    }
  });
});




        </script>



@endsection
