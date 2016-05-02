@extends('admin.layout')
@section('content')

        <section class="content-header">
          <h1>
            Flot Charts
            <small>preview sample</small>
          </h1>          
        </section>

        <!-- Main content -->
        <section class="content">          
          <div class="row">
            <div class="col-md-12">
              <!-- Bar chart -->
              <div class="box box-primary">
                <div class="box-header with-border">
                  <i class="fa fa-bar-chart-o"></i>
                  <h3 class="box-title">Monthly List of users this year</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body">
                  <div id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body-->
              </div><!-- /.box -->
          </div><!-- /.row -->
        </section><!-- /.content -->
@stop
@section('scripts')
<script type="text/javascript">
  var bar_data = {
          data: [["January", {{$data[0]}}], ["February", {{$data[1]}}], ["March", {{$data[2]}}], ["April", {{$data[3]}}], ["May", {{$data[4]}}], ["June", {{$data[5]}}], ["July", {{$data[6]}}], ["August", {{$data[7]}}], ["September", {{$data[8]}}], ["October", {{$data[9]}}], ["November", {{$data[10]}}], ["December", {{$data[11]}}]],
          color: "#3c8dbc"
        };
        $.plot("#bar-chart", [bar_data], {
          grid: {
            borderWidth: 1,
            borderColor: "#f3f3f3",
            tickColor: "#f3f3f3"
          },
          series: {
            bars: {
              show: true,
              barWidth: 0.5,
              align: "center"
            }
          },
          xaxis: {
            mode: "categories",
            tickLength: 0
          }
        });
    </script>
@stop