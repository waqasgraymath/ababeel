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
                <td><ul>
                    <?php 
                    $relay = 'default';
                    foreach ($topics as $topic) { 
                        
                            if ($topic->id == $topic_id) { ?>
                        <li><i>
                                    <a href="{{ URL::to('/topic_detail/'.$topic->id) }}" >
                                        <?php print_r($topic->title); ?>
                                    </a>
                                </i>
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
                                    <tr><th>as</th></tr>
                                    <tr>
                                            <?php
                                            if (isset($details))
                                            {
                                                foreach ($details as $detail)
                                                {
                                                    ?>
                                                    <td><?php echo $detail->title ?></td>
                                                    <td><?php echo $detail->short_message ?></td>
                                                    <td><?php echo $detail->long_message ?></td>
                                                    <td><?php echo $detail->action_url ?></td>
                                                    <td><?php echo $detail->your_system_id ?></td>
                                                    <td><?php echo $detail->end_point ?></td>
                                                    <td><?php echo $detail->secret ?></td>
                                                <?php
                                                }
                                            }
                                            ?>
                                        </tr>
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
