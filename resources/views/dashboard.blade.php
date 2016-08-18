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
    </head>
    <body>

        <h2><a href="{{ route('dashboard') }}" >Dashboard</a></h2>
        <table>
            <tr><th>Topics</th></tr>
            <tr>
                <td>
                    <?php foreach ($topics as $topic) { 
                            if ($topic->id == $topic_id) { ?>
                                <i>
                                    <a href="{{ URL::to('/topic_detail/'.$topic->id) }}" >
                                        <?php print_r($topic->title); ?>
                                    </a>
                                </i>
                            <?php }else { ?>
                                <a href="{{ URL::to('/topic_detail/'.$topic->id) }}" >
                                    <?php print_r($topic->title); ?>
                                </a>
                            <?php } } ?>
                </td>
                <td>
                    <table>
                        <tr>
                            <td><table>
                                    <tr><td>
                                            <?php
                                            if (isset($details))
                                            {
                                                foreach ($details as $detail)
                                                {
                                                    ?>
                                                    <?php echo $detail->title ?>
                                                    <?php echo $detail->short_message ?>
                                                    <?php echo $detail->long_message ?>
                                                    <?php echo $detail->action_url ?>
                                                    <?php echo $detail->end_point ?>
                                                    <?php echo $detail->secret ?>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </td></tr>
                                </table></td>
                                <td><?php
                                            if (isset($topic_id) != 0)
                                            { ?>
                                   <a href="{{ URL::to('/api/'.$topic_id) }}" >
                                        API
                                    </a> 
                                        <?php } ?>
                                </td>
                        </tr>
                    </table>                        
                </td>
            </tr>            
        </table>
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <br />
        <table>
            <tr><td><a href="{{ url('create_topic') }}" >Create Topic</a></td></tr>
        </table>

    </body>
</html>
