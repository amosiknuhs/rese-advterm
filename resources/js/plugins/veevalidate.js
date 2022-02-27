import Vue from "vue";

import {
    required,
    email,
    max,
    min,
    length,
    alpha_num,
    image,
} from "vee-validate/dist/rules";
import { extend, ValidationObserver, ValidationProvider } from "vee-validate";

Vue.component("ValidationObserver", ValidationObserver);
Vue.component("ValidationProvider", ValidationProvider);

extend("required", {
    ...required,
    message: "{_field_}を入力してください",
});

extend("selectRequired", {
    ...required,
    message: "{_field_}を選択してください",
});

extend("max", {
    ...max,
    message: "{_field_}は{length}文字以下で入力してください",
});

extend("min", {
    ...min,
    message: "{_field_}は{length}文字以上で入力してください",
});

extend("email", {
    ...email,
    message: "{_field_}の形式で入力してください",
});

extend("alpha_num", {
    ...alpha_num,
    message: "{_field_}は半角英数字で入力してください",
});

extend("length", {
    ...length,
    message: "{_field_}は{length}文字で入力してください",
});

extend("image", {
    ...image,
    message: "画像ファイルを選択してください",
});
