<div>
  <!--begin::Form-->
    <form action="{{route("faqs.store")}}" method="POST" id="myform" wire:submit.prevent="store">
        @csrf
        <div class="card-body">
            <!-- EN Form -->
            <div class="form-group">
                <label>@lang('Create A Question') <span class="text-danger">*</span></label>
                <input type="text" class="form-control {{ $errors->has('question') ? ' is-invalid' : '' }}" name="question"  wire:model="question" value="{{ old('question') }}"   placeholder="Ask Question"/>
                @error('question')
                    <div class="invalid-feedback">{{ $errors->first('question') }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleTextarea">@lang("Write an Answer")<span class="text-danger">*</span></label>
                <textarea  id="kt-ckeditor-1" name="answer"  wire:model="answer"   class="{{ $errors->has('question') ? ' is-invalid' : '' }}">

                </textarea>
                @error('answer')
                    <div class="invalid-feedback">{{ $errors->first('answer') }}</div>
                @enderror
            </div>
        <!-- AR Form -->
            <div class="form-group">
                <label>@lang("Create A Question (AR)") <span class="text-danger">*</span></label>
                <input type="text" class="form-control  {{ $errors->has('question_ar') ? ' is-invalid' : '' }}"value="{{ old('question_ar') }}"   name="question_ar"   wire:model="question_ar" placeholder="Ask Question"/>
                @error('question_ar')
                    <div class="invalid-feedback">{{ $errors->first('question_ar') }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleTextarea">@lang("Write A Answer (EN)") <span class="text-danger">*</span></label>
                <textarea   id="kt-ckeditor-2" name="answer_ar"  wire:model="answer_ar"  class="{{ $errors->has('question') ? ' is-invalid' : '' }}">

                </textarea>
                @error('answer_ar')
                    <div class="invalid-feedback">{{ $errors->first('answer_ar') }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2" wire:click="$emit('postAdded')">@lang("create") </button>
        </div>
    </form>

</div>
