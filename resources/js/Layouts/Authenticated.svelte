<script>
	import BreezeApplicationLogo from "@/Components/ApplicationLogo.svelte";
	import BreezeDropdown from "@/Components/Dropdown.svelte";
	import BreezeDropdownLink from "@/Components/DropdownLink.svelte";
	import BreezeNavLink from "@/Components/NavLink.svelte";
	import BreezeResponsiveNavLink from "@/Components/ResponsiveNavLink.svelte";
	import {inertia, page, Link, useForm, router} from "@inertiajs/svelte";
	import { __ } from 'laravel-translator';
	export let
		user = $page.props.auth.user,
		showingNavigationDropdown = false,
		confirmingEntityCreation = false;

	const form = useForm({
		password: '',
	});

	function closeModal() {
		confirmingEntityCreation = false;
		$form.clearErrors();
		$form.reset();
	}

	function switchEntity(e) {
		e.preventDefault();
		$form.patch(route('entity.switch', { entity: e.id }));
	}
</script>

<div>
	<div class="min-h-screen bg-gray-100 dark:bg-gray-900">
		<nav class="bg-white border-b border-gray-100 dark:bg-gray-800 dark:border-gray-300">
			<!-- Primary Navigation Menu -->
			<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
				<div class="flex justify-between h-16">
					<div class="flex">
						<!-- Logo -->
						<div class="shrink-0 flex items-center">
							<Link href="{ route('dashboard') }">
								<BreezeApplicationLogo
										class="block h-9 w-auto fill-current dark:text-white"
								/>
							</Link>
						</div>

						<!-- Navigation Links -->
						<div
								class="hidden space-x-8 sm:-my-px sm:ml-10 sm:flex"
						>
							<BreezeNavLink
									href="{ route('dashboard') }"
									active={$page.component === "Dashboard"}
							>
								Dashboard
							</BreezeNavLink>
							<BreezeNavLink
									href="{ route('about') }"
									active={$page.component === "About"}
							>
								About
							</BreezeNavLink>
						</div>
					</div>

					<div class="hidden sm:flex sm:items-center sm:ml-6">
						<!-- Entity Dropdown -->
						<div class="ml-3 relative">
							<BreezeDropdown
									class="w-48 origin-top-right right-0"
							>
                                <span
		                                class="inline-flex rounded-md"
		                                slot="trigger"
                                >
                                    <button
		                                    type="button"
		                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                    >
	                                    {#if $page.props.currentEntity !== null}
		                                    { $page.props.currentEntity.name }
	                                    {:else}
		                                    Select Entity
	                                    {/if}

	                                    <svg
			                                    class="ml-2 -mr-0.5 h-4 w-4"
			                                    xmlns="http://www.w3.org/2000/svg"
			                                    viewBox="0 0 20 20"
			                                    fill="currentColor"
	                                    >
                                            <path
		                                            fill-rule="evenodd"
		                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
		                                            clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
								<div slot="content">
									{#if $page.props.entities.length > 0}
										{#if $page.props.currentEntity !== null}
											<div>
												<BreezeDropdownLink
														href="{ route('entity.edit', {entity: $page.props.currentEntity.id}) }"

												>
													{ __('entity.edit_entity') }
												</BreezeDropdownLink>
											</div>
										{/if}
										<div>
											<span class="dark:text-gray-400 text-sm ml-2">Switch Entities</span>
											{#each $page.props.entities as entity}
												<BreezeDropdownLink
														href="{ route('entity.switch', { entity: entity.id }) }"
														method="patch"
														as="button"
														type="button"
												>
													{ entity.name }
												</BreezeDropdownLink>
											{/each}
										</div>
									{:else}
										No Entity Available
									{/if}

									<BreezeDropdownLink
											href="{ route('entity.create') }"
											method="get"
											as="button"
											type="button"
									>
										{ __('entity.create_entity') }
									</BreezeDropdownLink>
								</div>
							</BreezeDropdown>
						</div>
						<!-- Settings Dropdown -->
						<div class="ml-3 relative">
							<BreezeDropdown
									class="w-48 origin-top-right right-0"
							>
                                <span
		                                class="inline-flex rounded-md"
		                                slot="trigger"
                                >
                                    <button
		                                    type="button"
		                                    class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150"
                                    >
                                        {user.name}

	                                    <svg
			                                    class="ml-2 -mr-0.5 h-4 w-4"
			                                    xmlns="http://www.w3.org/2000/svg"
			                                    viewBox="0 0 20 20"
			                                    fill="currentColor"
	                                    >
                                            <path
		                                            fill-rule="evenodd"
		                                            d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z"
		                                            clip-rule="evenodd"
                                            />
                                        </svg>
                                    </button>
                                </span>
								<div slot="content">
									<BreezeDropdownLink
											href="{ route('profile.edit') }"
											method="get"
											as="button"
											type="button"
									>
										Profile
									</BreezeDropdownLink>
									<BreezeDropdownLink
											href="{ route('logout') }"
											method="post"
											as="button"
											type="button"
									>
										Log Out
									</BreezeDropdownLink>
								</div>
							</BreezeDropdown>
						</div>
					</div>

					<!-- Hamburger -->
					<div class="-mr-2 flex items-center sm:hidden">
						<button aria-label="Toggle Main Navigation"
								on:click={(evt) =>
                                (showingNavigationDropdown =
                                    !showingNavigationDropdown)}
								class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out"
						>
							<svg
									class="h-6 w-6"
									stroke="currentColor"
									fill="none"
									viewBox="0 0 24 24"
							>
								<path
										class:hidden={showingNavigationDropdown}
										class:inline-flex={!showingNavigationDropdown}
										stroke-linecap="round"
										stroke-linejoin="round"
										stroke-width="2"
										d="M4 6h16M4 12h16M4 18h16"
								/>
								<path
										class:hidden={!showingNavigationDropdown}
										class:inline-flex={showingNavigationDropdown}
										stroke-linecap="round"
										stroke-linejoin="round"
										stroke-width="2"
										d="M6 18L18 6M6 6l12 12"
								/>
							</svg>
						</button>
					</div>
				</div>
			</div>

			<!-- Responsive Navigation Menu -->
			<div
					class:block={showingNavigationDropdown}
					class:hidden={!showingNavigationDropdown}
					class="sm:hidden"
			>
				<div class="pt-2 pb-3 space-y-1">
					<BreezeResponsiveNavLink
							href="{ route('dashboard') }"
							active={$page.component === "Dashboard"}
					>
						Dashboard
					</BreezeResponsiveNavLink>
					<BreezeResponsiveNavLink
							href="{ route('about') }"
							active={$page.component === "About"}
					>
						About
					</BreezeResponsiveNavLink>
				</div>

				<!-- Responsive Settings Options -->
				<div class="pt-4 pb-1 border-t border-gray-200">
					<div class="px-4">
						<div class="font-medium text-base text-gray-800">
							{user.name}
						</div>
						<div class="font-medium text-sm text-gray-500">
							{user.email}
						</div>
					</div>

					<div class="mt-3 space-y-1">
						<BreezeDropdownLink
								href="{ route('profile.edit') }"
								method="get"
								as="button"
								type="button"
						>
							Profile
						</BreezeDropdownLink>
						<BreezeResponsiveNavLink
								href="{ route('logout') }"
								method="post"
								type="button"
						>
							Log Out
						</BreezeResponsiveNavLink>
					</div>
				</div>
			</div>
		</nav>

		<!-- Page Heading -->
		{#if $$slots.header}
			<!-- content here -->
			<header class="bg-white shadow dark:bg-gray-800">
				<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
					<slot name="header" />
				</div>
			</header>
		{/if}

		<!-- Page Content -->
		<main>
			<slot />
		</main>
	</div>
</div>