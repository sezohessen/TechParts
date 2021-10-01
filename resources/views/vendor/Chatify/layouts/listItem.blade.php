{{-- -------------------- Saved Messages -------------------- --}}
@if($get == 'saved')
    <table class="messenger-list-item m-li-divider @if('user_'.Auth::user()->id == $id && $id != "0") m-list-active @endif">
        <tr data-action="0">
            {{-- Avatar side --}}
            <td>
            <div class="avatar av-m" style="background-color: #d9efff; text-align: center;">
                <span class="far fa-bookmark" style="font-size: 22px; color: #68a5ff; margin-top: calc(50% - 10px);"></span>
            </div>
            </td>
            {{-- center side --}}
            <td>
                <p data-id="{{ 'user_'.Auth::user()->id }}">@lang('Saved Messages')</p>
                <span>@lang('Your chat')</span>
            </td>
        </tr>
    </table>
@endif

{{-- -------------------- All users/group list -------------------- --}}
@if($get == 'users')
    @if ($user->hasRole('seller'))
        <?php $seller = App\Models\Seller::where('user_id',$user->id)->first(); ?>
        <table class="messenger-list-item @if($user->id == $id && $id != "0") m-list-active @endif" data-contact="{{ $user->id }}">
            <tr data-action="0">
                {{-- Avatar side --}}
                <td style="position: relative">
                    @if($user->active_status)
                        <span class="activeStatus"></span>
                    @endif
                <div class="avatar av-m"
                style="background-image: url('{{  $seller->sellerAvatar ? find_image($seller->sellerAvatar,App\Models\Seller::avatarBase) : App\Models\User::InitialBase }}');">
                </div>
                </td>
                {{-- center side --}}
                <td>
                <p data-id="{{ $type.'_'.$user->id }}">
                    {{ strlen($user->FullName) > 12 ? trim(substr($user->FullName,0,12)).'..' : $user->FullName }}
                    <span>{{ $lastMessage->created_at->diffForHumans() }}</span>
                </p>
                <span>
                    {{-- Last Message user indicator --}}
                    {!!
                        $lastMessage->from_id == Auth::user()->id
                        ? '<span class="lastMessageIndicator">You :</span>'
                        : ''
                    !!}
                    {{-- Last message body --}}
                    @if($lastMessage->attachment == null)
                    {{
                        strlen($lastMessage->body) > 30
                        ? trim(substr($lastMessage->body, 0, 30)).'..'
                        : $lastMessage->body
                    }}
                    @else
                    <span class="fas fa-file"></span> @lang('Attachments')
                    @endif
                </span>
                {{-- New messages counter --}}
                    {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
                </td>

            </tr>
        </table>
    @else
        <table class="messenger-list-item @if($user->id == $id && $id != "0") m-list-active @endif" data-contact="{{ $user->id }}">
            <tr data-action="0">
                {{-- Avatar side --}}
                <td style="position: relative">
                    @if($user->active_status)
                        <span class="activeStatus"></span>
                    @endif
                <div class="avatar av-m"
                style="background-image: url('{{ asset(App\Models\User::InitialBase) }}');">
                </div>
                </td>
                {{-- center side --}}
                <td>
                <p data-id="{{ $type.'_'.$user->id }}">
                    {{ strlen($user->FullName) > 12 ? trim(substr($user->FullName,0,12)).'..' : $user->FullName }}
                    <span>{{ $lastMessage->created_at->diffForHumans() }}</span></p>
                <span>
                    {{-- Last Message user indicator --}}
                    {!!
                        $lastMessage->from_id == Auth::user()->id
                        ? '<span class="lastMessageIndicator">You :</span>'
                        : ''
                    !!}
                    {{-- Last message body --}}
                    @if($lastMessage->attachment == null)
                    {{
                        strlen($lastMessage->body) > 30
                        ? trim(substr($lastMessage->body, 0, 30)).'..'
                        : $lastMessage->body
                    }}
                    @else
                    <span class="fas fa-file"></span> Attachment
                    @endif
                </span>
                {{-- New messages counter --}}
                    {!! $unseenCounter > 0 ? "<b>".$unseenCounter."</b>" : '' !!}
                </td>

            </tr>
        </table>
    @endif
@endif

{{-- -------------------- Search Item -------------------- --}}
@if($get == 'search_item')
<table class="messenger-list-item" data-contact="{{ $user->user->id }}">
    <tr data-action="0">
        {{-- Avatar side --}}
        <td>

        <div class="avatar av-m"
        style="background-image: url('{{ $user->sellerAvatar ? find_image($user->sellerAvatar,App\Models\Seller::avatarBase) : App\Models\User::InitialBase }}');">
        </div>
        </td>
        {{-- center side --}}
        <td>
        <p data-id="{{ $type.'_'.$user->user->id }}">
            {{ strlen($user->user->FullName) > 12 ? trim(substr($user->user->FullName,0,12)).'..' : $user->user->FullName }}
        </td>

    </tr>
</table>
@endif

{{-- -------------------- Shared photos Item -------------------- --}}
@if($get == 'sharedPhoto')
<div class="shared-photo chat-image" style="background-image: url('{{ $image }}')"></div>
@endif


