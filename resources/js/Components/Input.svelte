<script>
	import { createEventDispatcher, onMount } from "svelte";

	const dispatch = createEventDispatcher();

	let className;
	let inputElement;

	export let value = "";
	export { className as class };

	function onInput() {
		dispatch("input", value);
	}

	onMount(() => {
		if (inputElement.hasAttribute("autofocus")) {
			inputElement.focus();
		}
	});
</script>

<input
		class="border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm mt-1 block w-full {className}"
		bind:value
		on:input={onInput}
		bind:this={inputElement}
		{...$$restProps}
/>