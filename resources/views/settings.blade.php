@extends('layouts.base')

@section('content')
    <div class="main">


        <div class="center_box cb">
            <div class="uo_tabs cf">
                <a href="#"><span>profile</span></a>
                <a href="#"><span>Reviews</span></a>
                <a href="#"><span>orders</span></a>
                <a href="#" class="active"><span>My Address</span></a>
                <a href="#"><span>Settings</span></a>
            </div>
            <div class="page_content bg_gray">
                @if(session()->has('isUpdate'))
                    @if(session()->get('isUpdate'))
                        <p class="bg-green text-white p20">
                            @lang('update.settings_success')
                        </p>
                    @else
                        <p class="bg-red text-white p20">
                            @lang('update.settings_fail')
                            @if (session()->has('errorUpdate') && session()->get('errorUpdate') !== '')
                                <br>
                                <span>Error: {{ session()->get('errorUpdate') }}</span>
                            @endif
                        </p>
                    @endif
                @endif

                <div class="uo_header">
                    <div class="wrapper cf">
                        <div class="wbox ava">
                            <figure><img src="imgc/user_ava_1_140.jpg" alt="Helena Afrassiabi" /></figure>
                        </div>
                        <div class="main_info">
                            <h1>Helena Afrassiabi</h1>
                            <div class="midbox">
                                <h4>560 points</h4>
                                <div class="info_nav">
                                    <a href="#">Get Free Points</a>
                                    <span class="sepor"></span>
                                    <a href="#">Win iPad</a>
                                </div>
                            </div>
                            <div class="stat">
                                <div class="item">
                                    <div class="num">30</div>
                                    <div class="title">total orders</div>
                                </div>
                                <div class="item">
                                    <div class="num">14</div>
                                    <div class="title">total reviews</div>
                                </div>
                                <div class="item">
                                    <div class="num">0</div>
                                    <div class="title">total gifts</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="uo_body">
                    <div class="wrapper">
                        <div class="uofb cf">
                            <div class="l_col adrs">
                                <h2>Add New Address</h2>

                                <form action="{{ route('settings.update') }}" method="post">
                                    @csrf

                                    @if($errors->has('name'))
                                        <span class="text-danger">{{ $errors->first('name') }}</span><br>
                                    @endif
                                    <div class="field">
                                        <label for="form-name">Name *</label>
                                        <input type="text" value="{{ old('name') }}" name="name" id="form-name" class="vl_empty" />
                                    </div>

                                    @if($errors->has('city'))
                                        <span class="text-danger">{{ $errors->first('city') }}</span><br>
                                    @endif
                                    <div class="field">
                                        <label for="form-city">Your city *</label>
                                        <select name="city" id="form-city">
                                            <option class="plh"></option>
                                            <option value="City 1">City 1</option>
                                            <option value="City 1">City 2</option>
                                        </select>
                                    </div>

                                    @if($errors->has('area'))
                                        <span class="text-danger">{{ $errors->first('area') }}</span><br>
                                    @endif
                                    <div class="field">
                                        <label for="form-area">Your area *</label>
                                        <select name="area" id="form-area">
                                            <option class="plh"></option>
                                            <option value="Area 1">Area 1</option>
                                            <option value="Area 2">Area 2</option>
                                        </select>
                                    </div>

                                    @if($errors->has('street'))
                                        <span class="text-danger">{{ $errors->first('street') }}</span><br>
                                    @endif
                                    <div class="field">
                                        <label for="form-street">Street</label>
                                        <input type="text" value="{{ old('street') }}" name="street" id="form-street" />
                                    </div>

                                    @if($errors->has('house'))
                                        <span class="text-danger">{{ $errors->first('house') }}</span><br>
                                    @endif
                                    <div class="field">
                                        <label for="form-house">House # </label>
                                        <input type="text" value="{{ old('house') }}" id="form-house" name="house" />
                                    </div>

                                    @if($errors->has('info'))
                                        <span class="text-danger">{{ $errors->first('info') }}</span><br>
                                    @endif
                                    <div class="field">
                                        <label for="form-info" class="pos_top">Additional information</label>
                                        <textarea name="info" id="form-info">{{ old('info') }}</textarea>
                                    </div>

                                    <div class="field">
                                        <input type="submit" name="submit" value="add_address" class="green_btn" />
                                    </div>
                                </form>
                            </div>

                            <div class="r_col">
                                <h2>My Addresses</h2>
                                <div class="uo_adr_list">
                                    @if(count($addresses) === 0)
                                        @lang('settings.note_add_addresses')
                                    @else
                                        @foreach($addresses as $address)
                                            <div class="item">
                                                <h3>{{ $address['name'] ?? '' }}</h3>
                                                <p>
                                                    {{ $address['city'] ?? '' }},
                                                    {{ $address['area'] ?? '' }}
                                                    <br>
                                                    {{ $address['street'] ?? '' }}
                                                    {{ $address['house'] ?? '' }}
                                                    <span class="d-block">{{ $address['info'] ?? '' }}</span>
                                                </p>
                                                <div class="actbox">
                                                    <form action="{{ route('settings.del_address') }}" method="post">
                                                        @csrf
                                                        <button class="bcross" name="del-id" value="{{ $address['id'] }}"></button>
                                                    </form>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
