<div class="row text-center py-5">
    <h5 class="text-center m-0 p-0">Email Settings</h5>
</div>

<div class="row mt-3">
    <div class="col-lg-6 mb-7">
        <x-metronic.label for="mail_driver" class="col-form-label fw-bold fs-6">{{ __('Mail Driver') }}</x-metronic.label>
        <x-metronic.input id="mail_driver" type="text" name="mail_driver"
            :value="old('mail_driver', optional($setting)->mail_driver)" placeholder="Mail Driver" />
    </div>

    <div class="col-lg-6 mb-7">
        <x-metronic.label for="mail_host" class="col-form-label fw-bold fs-6">{{ __('Mail Host') }}</x-metronic.label>
        <x-metronic.input id="mail_host" type="text" name="mail_host"
            :value="old('mail_host', optional($setting)->mail_host)" placeholder="Mail Host" />
    </div>

    <div class="col-lg-6 mb-7">
        <x-metronic.label for="mail_port" class="col-form-label fw-bold fs-6">{{ __('Mail Port') }}</x-metronic.label>
        <x-metronic.input id="mail_port" type="text" name="mail_port"
            :value="old('mail_port', optional($setting)->mail_port)" placeholder="Mail Port" />
    </div>

    <div class="col-lg-6 mb-7">
        <x-metronic.label for="mail_username" class="col-form-label fw-bold fs-6">{{ __('Mail Username') }}</x-metronic.label>
        <x-metronic.input id="mail_username" type="text" name="mail_username"
            :value="old('mail_username', optional($setting)->mail_username)" placeholder="Mail Username" />
    </div>

    <div class="col-lg-6 mb-7">
        <x-metronic.label for="mail_password" class="col-form-label fw-bold fs-6">{{ __('Mail Password') }}</x-metronic.label>
        <x-metronic.input id="mail_password" type="password" name="mail_password"
            :value="old('mail_password', optional($setting)->mail_password)" placeholder="Mail Password" />
    </div>
    <div class="col-lg-6 mb-7">
        <x-metronic.label for="mail_encryption" class="col-form-label fw-bold fs-6">{{ __('Mail Encryption') }}</x-metronic.label>
        <x-metronic.input id="mail_encryption" type="text" name="mail_encryption"
            :value="old('mail_encryption', optional($setting)->mail_encryption)" placeholder="Mail Encryption" />
    </div>
    <div class="col-lg-6 mb-7">
        <x-metronic.label for="mail_from_address" class="col-form-label fw-bold fs-6">{{ __('Mail From Address') }}</x-metronic.label>
        <x-metronic.input id="mail_from_address" type="email" name="mail_from_address"
            :value="old('mail_from_address', optional($setting)->mail_from_address)" placeholder="Mail From Address" />
    </div>
    <div class="col-lg-6 mb-7">
        <x-metronic.label for="mail_from_name" class="col-form-label fw-bold fs-6">{{ __('Mail From Name') }}</x-metronic.label>
        <x-metronic.input id="mail_from_name" type="text" name="mail_from_name"
            :value="old('mail_from_name', optional($setting)->mail_from_name)" placeholder="Mail From Name" />
    </div>
</div>
