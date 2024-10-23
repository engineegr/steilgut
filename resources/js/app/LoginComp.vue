<template>
	<div class="dropdown-login-pan">
		<i
			class="login-icon far fa-user-circle"
			style="font-size: 1.25em; color: #fff"
		></i>

		<div class="login">
			<ul class="login-list">
				<li><a class="login-item" href="http://www.ya.ru" /></li>
				<li><a class="login-item" href="http://www.ya.ru" /></li>
			</ul>
		</div>
	</div>
</template>

<script>
export default {};
</script>

<style lang="scss" scoped>
.dropdown-login-pan {
	display: flex;
	position: relative;
	align-self: flex-end;
	margin: 0.3em 2em 0 0;
}

.login {
	display: flex;
	position: absolute;
}

.login-pan .login ul.login-list {
	display: grid;
	flex-direction: column;
	justify-content: center;
	align-items: center;
	grid-template-rows: repeat(4, 1fr);
	grid-template-columns: 1fr;
}

.dropdown-login-pan .login ul.login-list a:hover {
	background-color: #ddd;
}

.dropdown-login-pan:hover .login {
	display: block;
}
</style>
