@extends('layout-unit')
@section('content')

 	<!-- Load Javascript Libraries (AngularJS, JQuery, Bootstrap) -->
    <script src="{{ asset('bower_components/angular/angular.min.js') }}"></script>

    <!-- Angular Utils Pagination -->
    <script src="{{ asset('bower_components/angularUtils-pagination/dirPagination.js') }}"></script>
  
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/app.js') }}"></script>
    
    <!-- AngularJS Application Scripts -->
    <script src="{{ asset('app/controllers/unit_scorecard.js') }}"></script>

    <script src="{{ asset('js/stickyheader.js') }}"></script>


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

    
    <div ng-app="unitScorecardApp" ng-controller="APIUnitScorecardController">
    	<div id="wrap">
    		<div class="row">
    			<div class="panel panel-info scorecard-custom-panel">
    					<div class="panel-heading scorecard-custom-heading">

                          
                          <img class="img-responsive unitdashboard-custom-picabb" src="{{ asset('uploads/unitpictures/cropped/'.''.$user->unit->PicturePath.'') }}">
						  
                            <h2 class="heading scorecard-custom-heading">
                                <b>{{ $user->unit->UnitAbbreviation }} Scorecard for {{ date("Y") }}</b>
                                <div class="col-md-3 pull-right">
                                    <a href="{{ url('report/currentYearUnitScorecard') }}" target="_blank">
                                        <button type="button" class="btn btn-warning btn-sm pull-right" ><i class="fa fa-save fa-fw"></i>Generate Report</button>
                                    </a> 
                                </div>
                            </h2>   
                            <i ng-show="loading" class="fa fa-spinner fa-spin"></i>


						</div><!--div panel-heading-->


						<div class="panel-body">
							<div class="table-responsive" >
    							<table class="table table-bordered floatThead-table">
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
    								<tr dir-paginate='unit_target in unit_targets|filter:search|itemsPerPage:5'>
                                        
                                        <td><% unit_target.unit_measure.unit_objective.UnitObjectiveName %>
                                            </td>

                                        <input type="hidden" value="<% unit_target.unit_measure.StaffMeasureID %>" ng-model="contributory" ng-init="c_measure=false">

                                        <td colspan="2"><% unit_target.unit_measure.UnitMeasureName %>
                                            <span class="label label-danger" ng-if="c_measure=unit_target.unit_measure.StaffMeasureID">Contributory to {{ $user->unit->staff->StaffAbbreviation }}</span>
                                        </td>

                                        <input type="hidden" ng-model="unittype" ng-init="c_type=unit_target.unit_measure.UnitMeasureType">


                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LG'"></td>
                                        <td style="text-align:center;" ng-if="c_type!='LD'"></td>
                                        <td style="text-align:center; background-color:#5cb85c" ng-if="c_type=='LD'"></td>


                                        <td><textarea rows="5" cols="30" id="id_owner<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" value="<% unit_target.unit_owner.UnitOwnerContent %>" ng-model="unit_target.unit_owner.UnitOwnerContent" autocomplete="off"  ng-touched /></textarea></td>

                                        <td class="scorecard-month"><% unit_target.JanuaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jan<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JanuaryAccomplishment  %>" ng-model="unit_target.unit_accomplishment.JanuaryAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.FebruaryTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_feb<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.FebruaryAccomplishment %>" ng-model="unit_target.unit_accomplishment.FebruaryAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.MarchTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_mar<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.MarchAccomplishment %>" ng-model="unit_target.unit_accomplishment.MarchAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.AprilTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_apr<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.AprilAccomplishment %>" ng-model="unit_target.unit_accomplishment.AprilAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.MayTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_may<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.MayAccomplishment %>" ng-model="unit_target.unit_accomplishment.MayAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.JuneTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jun<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JuneAccomplishment %>" ng-model="unit_target.unit_accomplishment.JuneAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.JulyTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_jul<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.JulyAccomplishment %>" ng-model="unit_target.unit_accomplishment.JulyAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.AugustTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_aug<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.AugustAccomplishment %>" ng-model="unit_target.unit_accomplishment.AugustAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.SeptemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_sep<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.SeptemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.SeptemberAccomplishment " autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.OctoberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_oct<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.OctoberAccomplishment %>" ng-model="unit_target.unit_accomplishment.OctoberAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.NovemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_nov<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.NovemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.NovemberAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td class="scorecard-month"><% unit_target.DecemberTarget | number: 2 %>/<input type='text' class="scorecard-input-month" id="id_dec<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_accomplishment.DecemberAccomplishment %>" ng-model="unit_target.unit_accomplishment.DecemberAccomplishment" autocomplete="off" class="form-control" ng-touched /></td>

                                        <td><textarea rows="5" cols="30" id="id_initiative<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" value="<% unit_target.unit_initiative.UnitInitiativeContent %>" ng-model="unit_target.unit_initiative.UnitInitiativeContent" autocomplete="off" ng-touched /></textarea></td>

                                        <td><input type='text' id="id_estimate<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_funding.UnitFundingEstimate %>" ng-model="unit_target.unit_funding.UnitFundingEstimate" autocomplete="off" class="form-control scorecard-input-estimate" ng-touched /></td>
                                       
                                        <td ><input type='text' id="id_actual<%unit_target.unit_measure.UnitMeasureID%>" name="monthlyform" valid-number value="<% unit_target.unit_funding.UnitFundingActual %>" ng-model="unit_target.unit_funding.UnitFundingActual" autocomplete="off" class="form-control scorecard-input-actual" ng-touched /></td>
                                        
                                        <td><% unit_target.unit_funding.UnitFundingEstimate - unit_target.unit_funding.UnitFundingActual | number: 2 %></td>

                                         <input type="hidden" name="UnitMeasureID" value="<%unit_target.unit_measure.UnitMeasureID%>" id="unitmeasure_id<%unit_target.unit_measure.UnitMeasureID%>">
                                         <input type="hidden" name="UnitID" value="<?=$user->unit->UnitID?>" id="unit_id<%unit_target.unit_measure.UnitMeasureID%>">
                                        <input type="hidden" name="UserUnitID" value="<?=$user->UserUnitID?>" id="user_unit_id<%unit_target.unit_measure.UnitMeasureID%>">
                                        <td>
                                               <button type="button"  class="btn btn-success btn-sm" id="btn-save" ng-click="save(modalstate, unit_target.UnitTargetID)"><i class="fa fa-save fa-fw"></i> Save Changes</button>
                                        </td>
                                    </tr>
    							</table>

                            </div>
                            <!--./table table striped-->
                            
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