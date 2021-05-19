<template>
    <div class="container">
        <div v-if="success" class="alert alert-success mt-3">
            Thanks for your message! We will get back to you shortly!
        </div>

        <h1>Contact Us</h1>
        <form @submit.prevent="submit" method="post">
            <div
                class="form-group"
                :class="{ invalid: validation.name === 'invalid' }"
            >
                <label>Name</label>
                <input
                    v-validate.continues="'required|max:50'"
                    v-model.trim="contact.name"
                    type="text"
                    name="name"
                    class="form-control"
                    @blur="validateName"
                />

                <p class="text-danger" v-if="validation.name === 'invalid'">
                    Required field
                </p>
                <div class="text-danger">
                    <li v-for="error in errors.collect('name')" :key="error">
                        {{ error }}
                    </li>
                </div>
            </div>

            <div
                class="form-group"
                :class="{ invalid: validation.email === 'invalid' }"
            >
                <label>Email</label>
                <input
                    v-validate.continues="'required|email'"
                    v-model.trim="contact.email"
                    type="text"
                    name="email"
                    class="form-control"
                    @blur="validateEmail"
                />
                <p class="text-danger" v-if="validation.email === 'invalid'">
                    Required field
                </p>
                <div class="text-danger">
                    <li v-for="error in errors.collect('email')" :key="error">
                        {{ error }}
                    </li>
                </div>
            </div>

            <div
                class="form-group"
                :class="{ invalid: validation.phone === 'invalid' }"
            >
                <label>Phone</label>
                <input
                    v-validate.continues="'required|max:50|numeric'"
                    v-model.trim="contact.phone"
                    name="phone"
                    class="form-control"
                    @blur="validatePhone"
                />
                <p class="text-danger" v-if="validation.phone === 'invalid'">
                    Required field
                </p>
                <div class="text-danger">
                    <li v-for="error in errors.collect('phone')" :key="error">
                        {{ error }}
                    </li>
                </div>
            </div>

            <div
                class="form-group"
                :class="{ invalid: validation.message === 'invalid' }"
            >
                <label>Message</label>
                <textarea
                    v-validate.continues="'|max:500'"
                    v-model.trim="contact.message"
                    type="text"
                    name="message"
                    rows="5"
                    class="form-control"
                    @blur="validateMessage"
                ></textarea>
                <p class="text-danger" v-if="validation.message === 'invalid'">
                    Message can not be empty!
                </p>
                <div class="text-danger">
                    <li v-for="error in errors.collect('message')" :key="error">
                        {{ error }}
                    </li>
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Save Contact
                </button>
            </div>
        </form>
    </div>
</template>

<script>
export default {
    data() {
        return {
            success: false,

            contact: {
                id: "",
                name: "",
                email: "",
                phone: "",
                message: ""
            },
            validation: {
                name: null,
                email: null,
                phone: null,
                message: null
            }
        };
    },

    mounted() {
        console.log("Contacts Component Loaded...");
    },

    methods: {
        submit() {
            this.success = false;

            console.log("Creating contact...");
            let self = this;
            let params = Object.assign({}, self.contact);

            axios
                .post("api/store", params)
                .then(() => {

                    this.loaded = true;
                    this.success = true;
                    self.contact.name = "";
                    self.contact.email = "";
                    self.contact.phone = "";
                    self.contact.message = "";
                    this.$validator.reset();
                })

                .catch(error => {
                    this.loaded = true;
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors || {};
                    }
                });

            console.log("Contact created...");
        },

        validateName() {
            if (this.contact.name === "") {
                this.validation.name = "invalid";
            } else {
                this.validation.name = "valid";
            }
        },

        validateEmail() {
            if (this.contact.email === "") {
                this.validation.email = "invalid";
            } else {
                this.validation.email = "valid";
            }
        },

        validatePhone() {
            if (this.contact.phone === "") {
                this.validation.phone = "invalid";
            } else {
                this.validation.phone = "valid";
            }
        },

        validateMessage() {
            if (this.contact.message === "") {
                this.validation.message = "invalid";
            } else {
                this.validation.message = "valid";
            }
        }
    }
};
</script>

<style>
.form-group.invalid input {
    border-color: red;
}
</style>
