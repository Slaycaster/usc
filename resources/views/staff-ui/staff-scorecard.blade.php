@extends('layout-staff')
@section('content')

    <!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/staff_scorecard.js') }}"></script>


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

.thinitiatives{
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

    <div ng-app="unitScorecardApp" ng-controller="APIStaffScorecardController">
        <div id="wrap">
            <div class="row">
                <div class="panel panel-info scorecard-custom-panel">
                        <div class="panel-heading scorecard-custom-heading">
                          <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/staffpictures/cropped/'.''.$staff_user->staff->PicturePath.'') }}">
                          
                            <h2 class="heading scorecard-custom-heading">
                                <b>{{ $staff_user->staff->StaffAbbreviation }} Scorecard for {{ date("Y") }}</b>
                            </h2>   
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>
                        </div><!--div panel-heading-->

                        <div class="panel-body">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                    <tr>
                                        <th rowspan="2" >
                                            <input type="text" class="scorecard-objectives" value="OBJECTIVES" disabled/>
                                        </th>
                                
                                        <th colspan="4">
                                            MEASURES
                                        </th>

                                        <th rowspan="2" class="thowner">
                                            <input type="text" class="scorecard-owner" value="OWNER" disabled/>
                                        </th>

                                        <th colspan="12">
                                            <b>TARGET/ACCOMPLISHMENT</b>
                                        </th>

                                        <th rowspan="2" class="thinitiatives">
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
                                    <tbody>
                                    <tr ng-repeat='staff_target in staff_targets'>
                                        
                                        <td><% staff_target.staff_measure.staff_objective.StaffObjectiveName %>
                                        </td>

                                        <input type="hidden" value="<% staff_target.staff_measure.ChiefMeasureID %>" ng-model="contributory" ng-init="c_measure=false">

                                        <td colspan="2"><% staff_target.staff_measure.StaffMeasureName %>
                                            <span class="label label-primary" ng-if="c_measure=staff_target.staff_measure.ChiefMeasureID">Contributory to C, PNP</span><br /><i style="font-size:10px;">Contributory/ies to this Measure</i>
                                            <!--Contributory Accomplishment--><br /><p ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'><span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </p>
                                            
                                        </td>

                                        <input type="hidden" ng-model="stafftype" ng-init="c_type=staff_target.staff_measure.StaffMeasureType">


                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LD'"></td>
                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LD'"></td>


                                        <td><textarea rows="5" cols="30" id="id_owner<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" value="<% staff_target.staff_owner.StaffOwnerContent %>" ng-model="staff_target.staff_owner.StaffOwnerContent" autocomplete="off"  ng-touched /></textarea></td>

     
                                        <td><% staff_target.JanuaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month"  id="id_jan<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JanuaryAccomplishment  %>" ng-model="staff_target.staff_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                            <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].JanuaryAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.FebruaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_feb<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.FebruaryAccomplishment %>" ng-model="staff_target.staff_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                            <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].FebruaryAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.MarchTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_mar<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.MarchAccomplishment %>" ng-model="staff_target.staff_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].MarchAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.AprilTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_apr<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.AprilAccomplishment %>" ng-model="staff_target.staff_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].AprilAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.MayTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_may<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.MayAccomplishment %>" ng-model="staff_target.staff_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].MayAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.JuneTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jun<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JuneAccomplishment %>" ng-model="staff_target.staff_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].JuneAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.JulyTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jul<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.JulyAccomplishment %>" ng-model="staff_target.staff_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].JulyAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.AugustTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_aug<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.AugustAccomplishment %>" ng-model="staff_target.staff_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].AugustAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.SeptemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_sep<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.SeptemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.SeptemberAccomplishment " autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].SeptemberAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.OctoberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_oct<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.OctoberAccomplishment %>" ng-model="staff_target.staff_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].OctoberAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.NovemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_nov<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.NovemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].NovemberAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>

                                        </td>

                                        <td><% staff_target.DecemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_dec<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_accomplishment.DecemberAccomplishment %>" ng-model="staff_target.staff_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" ng-touched />

                                             <!--Contributory Accomplishment-->
                                            <div ng-repeat='unit_measure in staff_target.staff_measure.unit_measures'>
                                                + <strong><% unit_measure.unit_accomplishments[0].DecemberAccomplishment %></strong> <span class="label label-default"><% unit_measure.unit_accomplishments[0].unit.UnitAbbreviation %></span>
                                            </div>


                                        </td>

                                        <td><textarea rows="5" cols="30" id="id_initiative<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" value="<% staff_target.staff_initiative.StaffInitiativeContent %>" ng-model="staff_target.staff_initiative.StaffInitiativeContent" autocomplete="off" ng-touched /></textarea></td>

                                        <td><input type='text' id="id_estimate<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_funding.StaffFundingEstimate %>" ng-model="staff_target.staff_funding.StaffFundingEstimate" autocomplete="off" class="form-control" ng-touched /></td>
                                        <td ><input type='text' id="id_actual<%staff_target.staff_measure.StaffMeasureID%>" name="monthlyform" valid-number value="<% staff_target.staff_funding.StaffFundingActual %>" ng-model="staff_target.staff_funding.StaffFundingActual" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td><% staff_target.staff_funding.StaffFundingEstimate - staff_target.staff_funding.StaffFundingActual | number: 2 %></td>

                                         <input type="hidden" name="StaffMeasureID" value="<%staff_target.staff_measure.StaffMeasureID%>" id="staffmeasure_id<%staff_target.staff_measure.StaffMeasureID%>">
                                         <input type="hidden" name="StaffID" value="<?=$staff_user->staff->StaffID?>" id="staff_id<%staff_target.staff_measure.StaffMeasureID%>">
                                        <input type="hidden" name="UserStaffID" value="<?=$staff_user->UserStaffID?>" id="user_staff_id<%staff_target.staff_measure.StaffMeasureID%>">
                                        <td>
                                               <button type="button"  class="btn btn-success btn-sm" id="btn-save" ng-click="save(modalstate, staff_target.StaffTargetID)"><i class="fa fa-save fa-fw"></i> Save Changes</button>
                                         </td>
                                    </tr>
                                    </tbody>
                                </table>

                        </div>
                            <!--./table table striped-->
                            <br>
                                
                           
                        <!-- div panel-body-->
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