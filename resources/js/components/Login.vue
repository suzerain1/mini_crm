<template>
    <div>

        <div class="form_container login_container">
            <h2>Admin Login</h2>
            <div class="error_msg" v-if="errors.value != ''">{{errors}}</div>
            <form class="form_create" @submit.prevent="loginUser">

                <div class="mb-3">
                    <label for="email" class="form-label">Email:</label>
                    <input type="email" class="form-control" id="email" name="email" v-model="form.email">
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" v-model="form.password">
                </div>

                <button type="submit" class="btn_submit">Login</button>
    
            </form>

        </div>
        
    </div>
</template>
<script>
import useAuth from '../composables/auth';
import { reactive } from 'vue';

export default ({
    setup() {
        
        const form = reactive({
            'email': '',
            'password': ''
        });

        const { errors, getUser } = useAuth();

        const loginUser = async () => {
            await getUser({
                data: {...form}
            });
        }

        return {
            form,
            errors,
            loginUser
        }

    },
})

</script>
