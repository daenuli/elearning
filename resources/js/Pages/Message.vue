<template>
    <div>
        <div v-if="$page.props.flash.warning" class="alert alert-warning" role="alert">
            <p>{{ $page.props.flash.warning }}</p>
        </div>
        <div v-if="$page.props.flash.error" class="alert alert-danger" role="alert">
            <p>{{ $page.props.flash.error }}</p>
        </div>
        <div v-if="$page.props.flash.success" class="alert alert-success" role="alert">
            <p>{{ $page.props.flash.success }}</p>
        </div>
    </div>
</template>