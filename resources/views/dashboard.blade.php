<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Dashboard</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <style>
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }
        th, td {
            padding: 15px;
        }
        </style>
    </head>
    <body>
        <?php $sussess = 0;
              $failure = 0;
        ?>
        <h2><a href="{{ route('dashboard') }}" >Dashboard</a></h2>
        <table>
            <tr><th>Topics</th>
                <td>
                    <?php  foreach ($topics as $topic) { 
                        
                            if ($topic->id == $topic_id) { ?>
                    <table>
                        <tr>Topic Details
                            <th>Owner id</th>
                            <th>Join Code</th>
                            <th>Relay</th>
                            <th>Active</th>
                            <th>email</th>
                            <th>sms</th>
                            <th>pn</th>
                            <?php if ($topic->relay != 'on demand'){ ?>
                                <th>occurance</th>
                                <th>interval</th>
                                <th>time unit</th>
                            <?php } ?>
                        </tr>
                        <tr>
                            <td><?php echo $topic->owner_id; ?></td>
                            <td><?php echo $topic->join_code; ?></td>
                            <td><?php echo $topic->relay; ?></td>
                            <td><?php echo $topic->active; ?></td>
                            <td><?php echo $topic->email; ?></td>
                            <td><?php echo $topic->sms; ?></td>
                            <td><?php echo $topic->pn; ?></td>
                            <?php if ($topic->relay != 'on demand'){ ?>
                                <td><?php echo $topic->occurance; ?></td>
                                <td><?php echo $topic->intervals; ?></td>
                                <td><?php echo $topic->time_unit; ?></td>
                            <?php } ?>
                        </tr>
                    </table>
                    
                    <?php } } ?>
                </td>
            </tr>
            <tr>
                <td><ul>
                    <?php 
                    $relay = 'default';
                    foreach ($topics as $topic) { 
                        
                            if ($topic->id == $topic_id) { ?>
                        <li><b><i>
                                    <a style="font-size: 20px;color: red;" href="{{ URL::to('/topic_detail/'.$topic->id) }}" >
                                        <?php print_r($topic->title); ?>
                                    </a>
                                </i>
                                </b>
                            </li>
                            <?php 
                            
                            $relay = $topic->relay;
                            
                            }else { ?>
                            <li>
                                <a href="{{ URL::to('/topic_detail/'.$topic->id) }}" >
                                    <?php print_r($topic->title); ?>
                                </a>
                            </li>
                            <?php } } ?>
                </ul>
                </td>
                <td>
                    <table>
                        <tr>
                            <td><table>
                                    <tr>
                                        <th>Title</th>
                                        <th>short_message</th>
                                        <th>long_message</th>
                                        <th>action_url</th>
                                        <th>your_system_id</th>
                                        <th>end_point</th>
                                        <th>secret</th>
                                        <th>See Log</th>
                                    </tr>
                                    
                                            <?php
                                            if (isset($details))
                                            {
                                                foreach ($details as $detail)
                                                {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $detail->title ?></td>
                                                    <td><?php echo $detail->short_message ?></td>
                                                    <td><?php echo $detail->long_message ?></td>
                                                    <td><?php echo $detail->action_url ?></td>
                                                    <td><?php echo $detail->your_system_id ?></td>
                                                    <td><?php echo $detail->end_point ?></td>
                                                    <td><?php echo $detail->secret ?></td>
                                                    <td>
                                                        <a href="{{ URL::to('/log/'.$detail->topic_id.'/'.$detail->id) }}" >
                                                            See Log
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                            }
                                            ?>
                                        
                                </table></td>
                                <td><?php 
                                            if (isset($topic_id) && $topic_id != 0)
                                            { ?>
                                   <a href="{{ URL::to('/api/'.$topic_id.'/'.$relay) }}" >
                                        Create API of selected topic
                                    </a> 
                                        <?php } ?>
                                </td>
                        </tr>
                    </table>                        
                </td>
            </tr>            
        </table>
        
        <table>
            <tr><td><a href="{{ url('create_topic') }}" >Create Topic</a></td></tr>
        </table>
        <table><tr><td>Log Of Cron
        <?php if (isset($logs))
                                            { ?>
        
        <table>
                                    <tr>
                                        <th>topic id</th>
                                        <th>message relay id</th>
                                        <th>status</th>
                                        <th>executed on</th>
                                    </tr>
                                    
                                            <?php
                                            
                                                foreach ($logs as $log)
                                                {
                                                    ?>
                                                <tr>
                                                    <td><?php echo $log->topic_id; ?></td>
                                                    <td><?php echo $log->message_relay_id; ?></td>
                                                    <td><?php echo $log->status; ?></td>
                                                    <td><?php echo $log->executed_on; ?></td>
                                                    <?php 
                                                    if ($log->status == 'success'){
                                                        $sussess++;
                                                    }else{
                                                        $failure++;
                                                    }
                                                    ?>
                                                    <td>
                                                        <a href="{{ URL::to('/log/'.$detail->topic_id.'/'.$detail->id) }}" >
                                                            See Log
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                }
                                            
                                            ?>
                                        
                                </table>
                                <?php } ?>
                </td>
                
                <td>
                    <script type="text/javascript">
window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		animationEnabled: true,
		title:{
			text: "The log of our cron"
		},
		data: [
		{
			type: "column", //change type to bar, line, area, pie, etc
			dataPoints: [
				{ label: "success", y: <?php echo $sussess; ?> },
				{ label: "failure", y: <?php echo $failure; ?> },
			]
		}
		]
		});

	chart.render();
}
</script>
<script type="text/javascript" src="{{ URL::asset('js/canvasjs.min.js') }}"></script>
<div id="chartContainer" style="height: 100%; width: 100%;"></div>
                </td>
            
            
            </tr></table>
    </body>
</html>
