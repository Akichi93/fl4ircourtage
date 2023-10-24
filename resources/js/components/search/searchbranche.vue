<template>
    <div class="col-row">
        <input type="text" class="form-control" :placeholder="placeholder"  />
    </div>
</template>
<script>
export default {
    name: "searchbranche",
    props: ['modelValue', 'placeholder'],
};
</script>