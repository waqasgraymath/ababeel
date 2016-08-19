<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>API Ping Check</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            <h3>API Ping Check</h3>
            <form action="{{ route('api_ping_check_store') }}" method="post" >
                <table>
                    <tr><th></th><th></th></tr>
                    <tr><td>Your API Secret</td><td><input readonly="readonly" type="text" id="secret" 
                                                           value="<?php echo rand('1000', '50000'); ?>" 
                        name="secret" /></td></tr>
                    <tr><td>End Point</td><td><input type="text" readonly="readonly"
                            value="api/relay/<?php echo $topic_id; ?>" id="end_point" name="end_point" /></td></tr>
                    <br />

                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                    <tr><td></td><td><input type="submit" value="submit" /></td></tr>
                </table>
            </form>
        </div>
    </body>
</html>
