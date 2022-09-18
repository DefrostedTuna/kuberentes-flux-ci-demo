# Kubernetes Flux CI Demo

<p align="center">
  <img src="https://img.shields.io/github/workflow/status/DefrostedTuna/kubernetes-flux-ci-demo/Master%20Workflow?style=flat-square" alt="Build Status">
</p>

This is a project used to showcase the workflow and orchestration of an application from development to deployment.

The branching strategy used here will follow the Gitflow standard where there is a long lived `master` and `develop` branch. Feature branches are merged into the `develop` branch, and when `develop` is ready for a release, the current state of `develop` will be merged into to `master` where a versioned (production) release will be made. The code present in `develop` should always be considered *unstable* and a *WIP*. Likewise, the state of the `master` branch should always reflect *production ready* code.

When a PR is opened against either the `develop` or `master` branch, GitHub Actions will run unit tests to verify the changes that were made. Once the PR has passed testing and has been merged, GitHub Actions will publish a Docker container reflecting the current state of the branch. This container will then be tagged and pushed to the remote Docker registry using the schema  `kubernetes-flux-ci-demo:{branch}-{commit-hash}`. A versioned release will only be made whenever a PR has been merged into `master`. This versioned release will simply be tagged using the SemVer schema `kubernetes-flux-ci-demo:{major}.{minor}.{patch}`.

The release itself will be completely automated by CI. The correct version number will be determined by the use of commit messages that follow the [Conventional Commits](https://www.conventionalcommits.org/en/v1.0.0/) standard. A changelog will also be generated automatically using the commit messages as well. With this being the case, it is vital that the Conventional Commits standard be followed when pushing commits and merging PRs.

Deployments will take place automatically once the Docker containers have been built via CI. The stipulations under which Docker containers are deployed are determined by the Flux operator within Kubernetes using the manifests within the associated GitOps repository.