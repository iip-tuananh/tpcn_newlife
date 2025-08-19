<script>
    class Policy extends BaseClass {
        no_set = [];

        before(form) {
        }

        after(form) {
        }


        get submit_data() {
            let data = {
                title: this.title,
                status: this.status,
                content: this.content,
                is_menu: this.is_menu,
            }

            data = jsonToFormData(data);

            return data;
        }
    }
</script>
