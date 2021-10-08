<div class="favorite-list-item">
    @if ($user->hasRole('seller'))
    <?php $seller = App\Models\Seller::where('user_id',$user->id)->first(); ?>
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            @if($seller->sellerAvatar)
                style="background-image: url('{{ find_image($seller->sellerAvatar,App\Models\Seller::avatarBase)  }}');">
            @else
                style="background-image: url('{{ asset(App\Models\User::InitialBase) }}');">
            @endif
        </div>
    @else
        <div data-id="{{ $user->id }}" data-action="0" class="avatar av-m"
            style="background-image: url('{{ asset(App\Models\User::InitialBase) }}');">
        </div>
    @endif
        <p>{{ strlen($user->FullName) > 5 ? substr($user->FullName,0,6).'..' : $user->FullName }}</p>
    </div>
