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
        <div>Dashboard</div>
        <table>
            <tr>
                <td><?php
                    foreach ($topics as $topic)
                    {
                        echo $topic->title;
                    }
                    ?>
                </td>
                <td>
                    <table>
                        <tr>
                            <td></td>
                            <td></td>
                        </tr>
                    </table>                        
                </td>
            </tr>
            <tr><td><a href="{{ url('/create_topic') }}" >Create Topic</a></td></tr>
        </table>
    </body>
</html>
