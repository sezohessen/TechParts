<div>
  <!--begin::Form-->
    <form action="{{route("faqs.store")}}" method="POST" id="myform" wire:submit.prevent="store">
        @csrf
        <div class="card-body">
            <!-- EN Form -->
            <div class="form-group">
                <label>@lang('faq creat question') <span class="text-danger">*</span></label>
                <input type="text" class="form-control {{ $errors->has('question') ? ' is-invalid' : '' }}" name="question"  wire:model="question"  placeholder="Ask Question"/>
                @error('question')
                    <div class="invalid-feedback">{{ $errors->first('question') }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleTextarea">@lang("faq create answer")<span class="text-danger">*</span></label>
                <textarea  id="kt-ckeditor-1" name="answer"  wire:model="answer" ></textarea>
                @error('answer')
                    <div class="invalid-feedback">{{ $errors->first('answer') }}</div>
                @enderror
            </div>
        <!-- AR Form -->
            <div class="form-group">
                <label>@lang("faq__create_question_ar") <span class="text-danger">*</span></label>
                <input type="text" class="form-control  {{ $errors->has('question_ar') ? ' is-invalid' : '' }}" name="question_ar"   wire:model="question_ar" placeholder="Ask Question"/>
                @error('question_ar')
                    <div class="invalid-feedback">{{ $errors->first('question_ar') }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="exampleTextarea">@lang("faq create answer ar") <span class="text-danger">*</span></label>
                <textarea   id="kt-ckeditor-2" name="answer_ar"  wire:model="answer_ar"></textarea>
                @error('answer_ar')
                    <div class="invalid-feedback">{{ $errors->first('answer_ar') }}</div>
                @enderror
            </div>
        </div>
        <div class="card-footer">
            <button type="submit" class="btn btn-primary mr-2">@lang("create") </button>
        </div>
    </form>

</div>
