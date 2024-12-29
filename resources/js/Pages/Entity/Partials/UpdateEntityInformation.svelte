<script>

import {__} from "laravel-translator";
import TransitionButton from "@/Components/TransitionButton.svelte";
import InputError from "@/Components/Error.svelte";
import TextInput from "@/Components/Input.svelte";
import InputLabel from "@/Components/Label.svelte";
import { useForm } from "@inertiajs/svelte";

let err = {};
export let errors = {}, classes, currentEntity, status;

const form = useForm({
	name: currentEntity.name,
	description: currentEntity.description,
});

$: if (currentEntity) {
	$form.name = currentEntity.name;
	$form.description = currentEntity.description;
}

function submit(e) {
	e.preventDefault();
	$form.patch(route('entity.update', currentEntity.id));
}
</script>

<section class={classes}>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			Update Entity Information
		</h2>

		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			Update your entity's profile information.
		</p>
	</header>

	<form
			onsubmit="{ submit }"
			class="mt-6 space-y-6"
	>
		<div>
			<InputLabel for="name" value="Name" />

			<TextInput
					id="name"
					type="text"
					classes="mt-1 block w-full"
					bind:value={$form.name}
					required
					autofocus
					autocomplete="name"
			/>

			<InputError message={$form.errors.name} />
		</div>

		<div>
			<InputLabel for="description" value="Description" />

			<TextInput
					id="description"
					type="text"
					classes="mt-1 block w-full"
					bind:value={$form.description}
					required
					autocomplete="username"
			/>

			<InputError message={$form.errors.description} />
		</div>

		<div class="flex items-center gap-4">
			<TransitionButton disabled={$form.processing} buttonLabel="Save" visible={$form.recentlySuccessful} text="{ __('entity.edit_updated') }" />
		</div>
	</form>
</section>