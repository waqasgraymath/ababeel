<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>API on Demand</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </head>
    <body>
        <div>
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <h3>API on Demand</h3>
            <form action="{{ route('api_on_demand_store') }}" method="post" >
                <table>
                    <tr><th></th><th></th></tr>
                    <tr><td>Your API Secret</td><td><input disabled="disabled" type="text" id="secret" 
                                                           value="<?php echo rand('1000', '50000'); ?>" 
                        name="secret" /></td></tr>
                    <tr><td>End Point</td><td><input type="text" disabled="disabled"
                            value="api/relay/<?php echo $topic_id; ?>" id="end_point" name="end_point" /></td></tr>
                    <br />

                    <tr><td>Your System Id</td><td><input type="text" id="your_system_id" name="your_system_id" /></td></tr>
                    <tr><td>Title</td><td><input type="text" id="title" name="title" /></td></tr>
                    <tr><td>Short Message</td><td><textarea id="short_message" name="short_message" ></textarea></td></tr>
                    <tr><td>Long Message</td><td><textarea id="long_message" name="long_message" ></textarea></td></tr>
                    <tr><td>Action Url</td><td><input type="text" id="action_url" name="action_url" /></td></tr>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <input type="hidden" name="topic_id" value="<?php echo $topic_id; ?>">
                    <tr><td></td><td><input type="submit" value="submit" /></td></tr>
                </table>
            </form>
        </div>
    </body>
</html>
