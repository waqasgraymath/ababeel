<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>On demand</title>
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
            <h3>Relay on demand</h3>
            <form action="{{ route('on_demand_store') }}" method="post" >
                <table>
                    <tr><th></th><th></th></tr>
                    <tr><td>Topic Title</td><td><input type="text" id="title" name="title" /></td></tr>
                    <tr><td>Join Code</td><td><input type="text" id="join_code" name="join_code" /></td></tr>
                    <tr><td>Active</td><td><input type="checkbox" value="1" id="active" name="active" /></td></tr>
                    <tr><td>Email</td><td><input type="checkbox" value="1" id="email" name="email" /></td></tr>
                    <tr><td>SMS</td><td><input type="checkbox" value="1" id="sms" name="sms" /></td></tr>
                    <tr><td>PN</td><td><input type="checkbox" value="1" id="pn" name="pn" /></td></tr>
                    <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                    <tr><td></td><td><input type="submit" value="submit" /></td></tr>
                </table>
            </form>
        </div>
    </body>
</html>
