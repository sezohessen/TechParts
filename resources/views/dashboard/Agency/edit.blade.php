{{-- Extends layout --}}
@extends('layout.master')

{{-- Content --}}
@section('content')
    {{-- Check if Car maker in Selected car makers
                                        --}}
                                        <option value="{{ $car_maker->id }}" selected>{{ $car_maker->name }}</option>
                                    @else
                                        <option value="{{ $car_maker->id }}">{{ $car_maker->name }}</option>
                                    @endif
                                @endforeach
                            </select>
                            @error('CarMaker_id')
                                <div class="invalid-feedback">{{ $errors->first('CarMaker_id') }}</div>
                            @enderror
                            <span class="form-text text-muted">@lang('You can choose more than one company')</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-primary mr-2">@lang('update') </button>
            </div>
        </form>
        <!--end::Form-->
    </div>

@endsection

{{-- Scripts Section --}}
@section('scripts')
    <script src="{{ asset('js/pages/crud/forms/widgets/select2.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/editors/ckeditor-classic.js') }}"></script>
    <script src="{{ asset('plugins/custom/ckeditor/ckeditor-classic.bundle.js') }}"></script>
    <script src="{{ asset('js/pages/crud/forms/validation/form-controls.js') }}"></script>
    <script>
        $('#country').on('change', function() {
            var id = this.value;
            $('#governorate').empty();
            $.ajax({
                url: '/dashboard/country/' + id,
                success: data => {
                    if (data.governorates) {
                        data.governorates.forEach(governorate =>
                            $('#governorate').append(
                                `<option value="${governorate.id}">${governorate.title}-${governorate.title_ar}</option>`
                                )
                        )
                    } else {
                        $('#governorate').append(`<option value="">No Results</option>`)
                    }
                }
            });
        });
        $('#governorate').on('change', function() {
            var id = this.value;
            $('#city').empty();
            $.ajax({
                url: '/dashboard/governorate/' + id,
                success: data => {
                    if (data.cities) {
                        data.cities.forEach(city =>
                            $('#city').append(
                                `<option value="${city.id}">${city.title}-${city.title_ar}</option>`
                                )
                        )
                    } else {
                        $('#city').append(`<option value="">No Results</option>`)
                    }
                }
            });
        });

    </script>
    <script>
        "use strict";
        var KTUserEdit = {
            init: function() {
                new KTImageInput("img_id");
            }
        };
        jQuery(document).ready((function() {
            KTUserEdit.init()
        }));

    </script>
    <script src='https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=places&amp;key={{ MapTOken() }}'>
    </script>
    <script src="{{ asset('js/locationpicker.jquery.js') }}"></script>
    <script>
        $('#map').locationpicker({
            location: {
                latitude: {
                    {
                        $lat
                    }
                },
                longitude: {
                    {
                        $long
                    }
                }
            },
            radius: 300,
            zoom: 13,
            markerIcon: "{{ url('/media/svg/icons/Map/google-maps.png') }}",
            inputBinding: {
                latitudeInput: $('#lat'),
                longitudeInput: $('#long'),
                locationNameInput: $("#address")
            },
            enableAutocomplete: true

        });

    </script>
@endsection
