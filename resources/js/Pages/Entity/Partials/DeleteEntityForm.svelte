<script>
import SecondaryButton from "@/Components/SecondaryButton.svelte";
import InputError from "@/Components/Error.svelte";
import DangerButton from "@/Components/DangerButton.svelte";
import TextInput from "@/Components/Input.svelte";
import Modal from "@/Components/Modal.svelte";
import InputLabel from "@/Components/Label.svelte";
import {useForm} from "@inertiajs/svelte";
export let confirmingEntityDeletion = false, currentEntity, classes;

$: {

}

let form = useForm({
	password: null,
});

function confirmEntityDeletion() {
	confirmingEntityDeletion = true;
}

function closeModal() {
	confirmingEntityDeletion = false;

	$form.clearErrors();
	$form.reset();
}

function deleteEntity(e) {
	e.preventDefault();
	$form.delete(route('entity.delete', {entity: currentEntity.id}), {
		preserveScroll: true,
		onSuccess: () => {
			$form.reset();
			closeModal();
		},
		onError: () => $form.reset(),
	});
}

</script>

<section class=space-y-6 {classes}>
	<header>
		<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
			Delete Entity
		</h2>

		<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
			Once your entity is deleted, all of its resources and data will
			be permanently deleted. Before deleting your entity, please
			download any data or information that you wish to retain.
		</p>
	</header>

	<DangerButton onClick="{ confirmEntityDeletion }">Delete Entity</DangerButton>

	<Modal show="{confirmingEntityDeletion}" onClose="{ closeModal }">
		<div class="p-6">
			<h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
				Are you sure you want to delete your entity?
			</h2>

			<p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
				Once your entity is deleted, all of its resources and data will
				be permanently deleted. Please enter your password to confirm
				you would like to permanently delete your entity.
			</p>

			<div class="mt-6">
				<InputLabel for="password" value="Password" classes="sr-only" />

				<TextInput
						id="password"
						bind:value={$form.password}
						type="password"
						classes="mt-1 block w-3/4"
						placeholder="Password"
						on:keyup.enter={deleteEntity}
				/>

				<InputError message={$form.errors.password} />
			</div>

			<div class="mt-6 flex justify-end">
				<SecondaryButton onClick={closeModal}>Cancel</SecondaryButton>

				<DangerButton
						disabled={$form.processing}
						onClick={deleteEntity}
						classes="ml-3"
				>
					Delete Entity
				</DangerButton>
			</div>
		</div>
	</Modal>
</section>