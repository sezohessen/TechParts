<?php use App\Models\User;
    $user=User::find($causer_id);
?>
<div class="text-warning text-hover-dange">
    {{$user->email ?? "Undefined"}}
</div>

