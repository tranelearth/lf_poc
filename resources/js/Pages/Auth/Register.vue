<template>
    <Head title="Register" />

    <jet-authentication-card>
        <template #logo>
            <jet-authentication-card-logo />
        </template>

        <jet-validation-errors />

        <form @submit.prevent="submit">
            <div>
                <jet-label for="first_name" value="First Name" />
                <jet-input id="first_name" type="text" v-model="form.first_name" required autofocus autocomplete="name" />
            </div>

            <div>
                <jet-label for="last_name" value="Last Name" />
                <jet-input id="last_name" type="text" v-model="form.last_name" required autofocus autocomplete="name" />
            </div>

            <div>
                <jet-label for="email" value="Email" />
                <jet-input id="email" type="email" v-model="form.email" required />
            </div>

            <div>
                <jet-label for="password" value="Password" />
                <jet-input id="password" type="password" v-model="form.password" required autocomplete="new-password" />
            </div>

            <div>
                <jet-label for="password_confirmation" value="Confirm Password" />
                <jet-input id="password_confirmation" type="password" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div v-if="$page.props.jetstream.hasTermsAndPrivacyPolicyFeature">
                <jet-label for="terms">
                    <div>
                        <jet-checkbox name="terms" id="terms" v-model:checked="form.terms" />

                        <div>
                            I agree to the <a target="_blank" :href="route('terms.show')">Terms of Service</a> and <a target="_blank" :href="route('policy.show')">Privacy Policy</a>
                        </div>
                    </div>
                </jet-label>
            </div>

            <div>
                <Link :href="route('login')">
                    Already registered?
                </Link>

                <jet-button :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </jet-button>
            </div>
        </form>
    </jet-authentication-card>
</template>

<script>
    import { defineComponent } from 'vue'
    import JetAuthenticationCard from '@/Jetstream/AuthenticationCard.vue'
    import JetAuthenticationCardLogo from '@/Jetstream/AuthenticationCardLogo.vue'
    import JetButton from '@/Jetstream/Button.vue'
    import JetInput from '@/Jetstream/Input.vue'
    import JetCheckbox from '@/Jetstream/Checkbox.vue'
    import JetLabel from '@/Jetstream/Label.vue'
    import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
    import { Head, Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Head,
            JetAuthenticationCard,
            JetAuthenticationCardLogo,
            JetButton,
            JetInput,
            JetCheckbox,
            JetLabel,
            JetValidationErrors,
            Link,
        },

        data() {
            return {
                form: this.$inertia.form({
                    first_name: '',
                    last_name: '',
                    email: '',
                    password: '',
                    password_confirmation: '',
                    terms: false,
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('register'), {
                    onFinish: () => this.form.reset('password', 'password_confirmation'),
                })
            }
        }
    })
</script>
