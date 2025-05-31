<div class="py-5 text-center row">
    <div class="card">
        <div class="bg-black card-header">
            <div class="card-title">
                <h3 class="p-0 m-0 text-center text-white">Website Information</h3>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Branding -->
    <div class="col-lg-3 mb-7">
        <x-metronic.label for="website_name"
            class="col-form-label fw-bold fs-6">{{ __('Website Name') }}</x-metronic.label>
        <x-metronic.input id="website_name" type="text" name="website_name" :value="old('website_name', optional($setting)->website_name)"
            placeholder="Site Name" />
    </div>

    <div class="col-lg-3 mb-7">
        <x-metronic.label for="site_title" class="col-form-label fw-bold fs-6">{{ __('Site Title') }}</x-metronic.label>
        <x-metronic.input id="site_title" type="text" name="site_title" :value="old('site_title', optional($setting)->site_title)" placeholder="Site Title" />
    </div>

    <!-- Contact Information -->
    <div class="col-lg-3 mb-7">
        <x-metronic.label for="primary_email"
            class="col-form-label fw-bold fs-6">{{ __('Primary Email') }}</x-metronic.label>
        <x-metronic.input id="primary_email" type="email" name="primary_email" :value="old('primary_email', optional($setting)->primary_email)"
            placeholder="Primary Email" />
    </div>

    <div class="col-lg-3 mb-7">
        <x-metronic.label for="support_email"
            class="col-form-label fw-bold fs-6">{{ __('Support Email') }}</x-metronic.label>
        <x-metronic.input id="support_email" type="email" name="support_email" :value="old('support_email', optional($setting)->support_email)"
            placeholder="Support Email" />
    </div>
    <div class="col-lg-3 mb-7">
        <x-metronic.label for="info_email" class="col-form-label fw-bold fs-6">{{ __('Info Email') }}</x-metronic.label>
        <x-metronic.input id="info_email" type="email" name="info_email" :value="old('info_email', optional($setting)->info_email)" placeholder="Info Email" />
    </div>
    <div class="col-lg-3 mb-7">
        <x-metronic.label for="news_email" class="col-form-label fw-bold fs-6">{{ __('News Email') }}</x-metronic.label>
        <x-metronic.input id="news_email" type="email" name="news_email" :value="old('news_email', optional($setting)->news_email)" placeholder="News Email" />
    </div>


    <!-- Logos and Images -->
    <div class="col-lg-3 mb-7">
        <x-metronic.label for="site_logo_white"
            class="col-form-label fw-bold fs-6">{{ __('Site Logo White') }}</x-metronic.label>
        <x-metronic.file-input id="site_logo_white" name="site_logo_white" :source="optional($setting)->site_logo_white ? asset('storage/' . $setting->site_logo_white) : null" />
    </div>

    <div class="col-lg-3 mb-7">
        <x-metronic.label for="site_logo_black"
            class="col-form-label fw-bold fs-6">{{ __('Site Logo Black') }}</x-metronic.label>
        <x-metronic.file-input id="site_logo_black" name="site_logo_black" :source="optional($setting)->site_logo_black ? asset('storage/' . $setting->site_logo_black) : null" />
    </div>

    <div class="col-lg-3 mb-7">
        <x-metronic.label for="site_favicon"
            class="col-form-label fw-bold fs-6">{{ __('Site Favicon') }}</x-metronic.label>
        <x-metronic.file-input id="site_favicon" name="site_favicon" :source="optional($setting)->site_favicon ? asset('storage/' . $setting->site_favicon) : null" />
    </div>

    <div class="col-lg-3 mb-7">
        <x-metronic.label for="login_background_image"
            class="col-form-label fw-bold fs-6">{{ __('Login Background Image') }}</x-metronic.label>
        <x-metronic.file-input id="login_background_image" name="login_background_image" :source="optional($setting)->login_background_image
            ? asset('storage/' . $setting->login_background_image)
            : null" />
    </div>

    <div class="col-lg-3 mb-7">
        <x-metronic.label for="system_timezone"
            class="col-form-label fw-bold fs-6">{{ __('Timezone') }}</x-metronic.label>
        <x-metronic.input id="system_timezone" type="text" name="system_timezone" :value="old('system_timezone', optional($setting)->system_timezone)"
            placeholder="System Timezone" />
    </div>

    <!-- Phones -->
    <div class="col-lg-3 mb-7">
        <x-metronic.label for="primary_phone"
            class="col-form-label fw-bold fs-6">{{ __('Primary Phone') }}</x-metronic.label>
        <x-metronic.input id="primary_phone" type="text" name="primary_phone" :value="old('primary_phone', optional($setting)->primary_phone)"
            placeholder="Primary Phone" />
    </div>

    <div class="col-lg-3 mb-7">
        <x-metronic.label for="fax" class="col-form-label fw-bold fs-6">{{ __('Fax') }}</x-metronic.label>
        <x-metronic.input id="fax" type="text" name="fax" :value="old('fax', optional($setting)->fax)" placeholder="Fax" />
    </div>

    <div class="col-lg-3 mb-7">
        <x-metronic.label for="alternative_phone"
            class="col-form-label fw-bold fs-6">{{ __('Alternative Phone') }}</x-metronic.label>
        <x-metronic.input id="alternative_phone" type="text" name="alternative_phone" :value="old('alternative_phone', optional($setting)->alternative_phone)"
            placeholder="Alternative Phone" />
    </div>

    <div class="col-lg-2 mb-7">
        <x-metronic.label for="whatsapp_number"
            class="col-form-label fw-bold fs-6">{{ __('Whatsapp Number') }}</x-metronic.label>
        <x-metronic.input id="whatsapp_number" type="text" name="whatsapp_number" :value="old('whatsapp_number', optional($setting)->whatsapp_number)"
            placeholder="Whatsapp Number" />
    </div>

    <div class="col-lg-2 mb-7">
        <x-metronic.label for="default_language"
            class="col-form-label fw-bold fs-6">{{ __('Default Language') }}</x-metronic.label>
        <x-metronic.input id="default_language" type="text" name="default_language" :value="old('default_language', optional($setting)->default_language)"
            placeholder="Default Language" />
    </div>

    <div class="col-lg-2 mb-7">
        <x-metronic.label for="default_currency"
            class="col-form-label fw-bold fs-6">{{ __('Default Currency') }}</x-metronic.label>
        <x-metronic.input id="default_currency" type="text" name="default_currency" :value="old('default_currency', optional($setting)->default_currency)"
            placeholder="Default Currency" />
    </div>


    <!-- Address -->
    <div class="col-lg-4 mb-7">
        <x-metronic.label for="address_one"
            class="col-form-label fw-bold fs-6">{{ __('Address One') }}</x-metronic.label>
        <textarea id="address_one" name="address_one" rows="4" class="form-control form-control-solid">{{ old('address_one', optional($setting)->address_one) }}</textarea>
    </div>

    <div class="col-lg-4 mb-7">
        <x-metronic.label for="address_two"
            class="col-form-label fw-bold fs-6">{{ __('Address Two') }}</x-metronic.label>
        <textarea id="address_two" name="address_two" rows="4" class="form-control form-control-solid">{{ old('address_two', optional($setting)->address_two) }}</textarea>
    </div>

    <!-- Timezone & Language -->

    <div class="col-lg-4 mb-7">
        <x-metronic.label for="site_motto"
            class="col-form-label fw-bold fs-6">{{ __('Site Motto') }}</x-metronic.label>
        <textarea name="site_motto" id="site_motto" rows="4" class="form-control form-control-solid">{{ old('site_motto', optional($setting)->site_motto) }}</textarea>
    </div>
</div>
