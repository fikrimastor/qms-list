<script>
	import BreezeInput from "@/Components/Input.svelte";
	import BreezeLabel from "@/Components/Label.svelte";
	import { useForm } from "@inertiajs/svelte";
	import { __ } from 'laravel-translator';
	import TransitionButton from "@/Components/TransitionButton.svelte";
	import BreezeAuthenticatedLayout from "@/Layouts/Authenticated.svelte";
	import InputError from "@/Components/Error.svelte";
	export let message;
	export let classes = 'space-y-6';

	const form = useForm({
		name: null,
		description: null,
	});

	function submit(e) {
		e.preventDefault();
		$form.post(route('entity.store'), {
			onSuccess: () => {
				$form.reset();
			},
		});
	}
</script>

<svelte:head>
	<title>{ __('entity.entities') }</title>
</svelte:head>

<BreezeAuthenticatedLayout>
	<h2 class="font-semibold text-xl text-gray-800 leading-tight" slot="header">
		{ __('entity.entities') }
	</h2>

	<div class="py-12">
		<div class="mx-auto max-w-7xl space-y-6 sm:px-6 lg:px-8">
			<div
					class="bg-white p-4 shadow sm:rounded-lg sm:p-8 dark:bg-gray-800"
			>
				<section class={classes}>
					<header>
						<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
							{ __('entity.create_entity') }
						</h2>

						<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
							{ __('entity.create_entity_description') }
						</p>
					</header>

					<form onsubmit={submit}>
						<div>
							<BreezeLabel for="name" value="Name" />
							<BreezeInput
									id="name"
									type="text"
									class="mt-1 block w-full"
									bind:value={$form.name}
									required
									autofocus
									autocomplete="new-password"
									on:input={(evt) => ($form.name = evt.detail)}
							/>

							<InputError message={$form.errors.name} />
						</div>

						<div class="mt-4">
							<BreezeLabel for="description" value="Description" />
							<BreezeInput
									id="description"
									type="description"
									class="mt-1 block w-full"
									bind:value={$form.description}
									required
									autocomplete="new-password"
									on:input={(evt) => ($form.description = evt.detail)}
							/>

							<InputError message={$form.errors.description} />
						</div>

						<div class="flex items-center mt-4">
							<TransitionButton disabled={$form.processing} buttonLabel="{ __('entity.create_entity') }" visible={$form.recentlySuccessful} text="{ message }" />
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
</BreezeAuthenticatedLayout>